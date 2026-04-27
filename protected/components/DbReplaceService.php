<?php
namespace application\components;

class DbReplaceService
{
    public function run($from, $to, $dryRun = true, $allowTruncate = false)
    {
        $db = \Yii::app()->db;
        $driver = $db->getDriverName();
        if ($driver !== 'mysql') {
            throw new \RuntimeException('Only MySQL is supported');
        }
        $columns = $this->getMysqlTextColumns($db);
        $results = [];
        $totalAffected = 0;
        $like = '%' . $from . '%';
        foreach ($columns as $c) {
            $table = $db->quoteTableName($c['TABLE_NAME']);
            $col = $db->quoteColumnName($c['COLUMN_NAME']);
            // Используем колляцию столбца (если она CI) для регистронезависимой замены
            $ciCollation = $this->resolveCiCollation($c);
            $colExpr = $ciCollation ? "$col COLLATE $ciCollation" : $col;
            $charset = isset($c['CHARACTER_SET_NAME']) && $c['CHARACTER_SET_NAME']
                ? $c['CHARACTER_SET_NAME']
                : 'utf8mb4';
            $fromExpr = $ciCollation
                ? "CONVERT(:from USING $charset) COLLATE $ciCollation"
                : ":from";
            $baseExpr = "REPLACE($colExpr, $fromExpr, :to)";
            $expr = $baseExpr;
            $lenGuard = '';
            if (in_array($c['DATA_TYPE'], ['char','varchar'], true) && !empty($c['CHARACTER_MAXIMUM_LENGTH'])) {
                if ($allowTruncate) {
                    // Без охраны по длине: обрежем, если не влазит
                    $expr = "CASE WHEN CHAR_LENGTH($baseExpr) <= " . (int)$c['CHARACTER_MAXIMUM_LENGTH'] . " THEN $baseExpr ELSE LEFT($baseExpr, " . (int)$c['CHARACTER_MAXIMUM_LENGTH'] . ") END";
                } else {
                    $lenGuard = " AND CHAR_LENGTH($baseExpr) <= " . (int)$c['CHARACTER_MAXIMUM_LENGTH'];
                }
            }
            $where = "$colExpr LIKE :like";
            $sqlCount = "SELECT COUNT(*) FROM $table WHERE $where$lenGuard";
            $sqlUpdate = "UPDATE $table SET $col = $expr WHERE $where$lenGuard";
            $paramsCount = [':like' => $like];
            if ($lenGuard !== '') { // только когда ограничиваем длину
                $paramsCount[':from'] = $from;
                $paramsCount[':to'] = $to;
            }
            $paramsUpdate = [':from' => $from, ':to' => $to, ':like' => $like];
            $count = (int)$db->createCommand($sqlCount)->queryScalar($paramsCount);
            $affected = 0;
            if (!$dryRun && $count > 0) {
                $affected = (int)$db->createCommand($sqlUpdate)->execute($paramsUpdate);
                // Если остались совпадения, добиваем их PHP-фолбэком (регистронезависимо)
                $leftover = (int)$db->createCommand("SELECT COUNT(*) FROM $table WHERE $where")
                    ->queryScalar([':like' => $like]);
                if ($leftover > 0) {
                    $affected += $this->fallbackPhpUpdate($db, $c, $from, $to, $allowTruncate);
                }
                $totalAffected += $affected;
            }
            if ($count > 0 || !$dryRun) {
                $results[] = [
                    'table' => $c['TABLE_NAME'],
                    'column' => $c['COLUMN_NAME'],
                    'count' => $count,
                    'affected' => $affected,
                ];
            }
        }
        return ['rows' => $results, 'totalAffected' => $totalAffected];
    }

    private function getMysqlTextColumns(\CDbConnection $db)
    {
        $sql = "SELECT TABLE_NAME,COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,COLLATION_NAME,CHARACTER_SET_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND DATA_TYPE IN ('char','varchar','text','mediumtext','longtext')";
        return $db->createCommand($sql)->queryAll();
    }

    private function resolveCiCollation(array $colInfo)
    {
        $collation = isset($colInfo['COLLATION_NAME']) ? $colInfo['COLLATION_NAME'] : null;
        $charset = isset($colInfo['CHARACTER_SET_NAME']) ? $colInfo['CHARACTER_SET_NAME'] : null;
        if ($collation && stripos($collation, '_ci') !== false) {
            return $collation; // уже case-insensitive
        }
        if ($charset) {
            // дефолтная CI-колляция для charset
            switch (strtolower($charset)) {
                case 'utf8mb4': return 'utf8mb4_general_ci';
                case 'utf8':    return 'utf8_general_ci';
                case 'latin1':  return 'latin1_swedish_ci';
                default:        return null;
            }
        }
        return null;
    }

    private function fallbackPhpUpdate(\CDbConnection $db, array $colInfo, $from, $to, $allowTruncate = false)
    {
        $tableName = $colInfo['TABLE_NAME'];
        $columnName = $colInfo['COLUMN_NAME'];
        $dataType = isset($colInfo['DATA_TYPE']) ? $colInfo['DATA_TYPE'] : null;
        $maxLen = isset($colInfo['CHARACTER_MAXIMUM_LENGTH']) ? (int)$colInfo['CHARACTER_MAXIMUM_LENGTH'] : null;

        $pkCols = $this->getPrimaryKeyColumns($db, $tableName);
        if (empty($pkCols)) {
            return 0; // без PK небезопасно обновлять
        }

        $qTable = $db->quoteTableName($tableName);
        $qCol = $db->quoteColumnName($columnName);
        $ciCollation = $this->resolveCiCollation($colInfo);
        $colExpr = $ciCollation ? "$qCol COLLATE $ciCollation" : $qCol;

        $selectCols = array_map(function ($c) use ($db) { return $db->quoteColumnName($c); }, $pkCols);
        $selectCols[] = $qCol . ' AS _val';
        $like = '%' . $from . '%';
        $sqlSel = 'SELECT ' . implode(',', $selectCols) . " FROM $qTable WHERE $colExpr LIKE :like";
        $rows = $db->createCommand($sqlSel)->queryAll([':like' => $like]);

        $affected = 0;
        $enc = 'UTF-8';
        foreach ($rows as $row) {
            $orig = $row['_val'];
            if ($orig === null || $orig === '') {
                continue;
            }
            $new = $this->mbStrIreplace($from, $to, $orig, $enc);
            if ($new === $orig) {
                continue; // ничего менять
            }
            if (in_array($dataType, ['char','varchar'], true) && $maxLen) {
                $newLen = function_exists('mb_strlen') ? mb_strlen($new, $enc) : strlen($new);
                if ($newLen > $maxLen) {
                    if ($allowTruncate) {
                        $new = function_exists('mb_substr') ? mb_substr($new, 0, $maxLen, $enc) : substr($new, 0, $maxLen);
                    } else {
                        continue; // переполнение длины
                    }
                }
            }

            $whereParts = [];
            $params = [':val' => $new];
            $i = 0;
            foreach ($pkCols as $pk) {
                $i++;
                $whereParts[] = $db->quoteColumnName($pk) . ' = :pk' . $i;
                $params[':pk' . $i] = $row[$pk];
            }
            $sqlUpd = "UPDATE $qTable SET $qCol = :val WHERE " . implode(' AND ', $whereParts);
            $affected += (int)$db->createCommand($sqlUpd)->execute($params);
        }

        return $affected;
    }

    private function getPrimaryKeyColumns(\CDbConnection $db, $tableName)
    {
        $sql = "SELECT kcu.COLUMN_NAME
                FROM information_schema.TABLE_CONSTRAINTS tc
                INNER JOIN information_schema.KEY_COLUMN_USAGE kcu
                  ON tc.CONSTRAINT_NAME = kcu.CONSTRAINT_NAME
                 AND tc.TABLE_SCHEMA = kcu.TABLE_SCHEMA
                 AND tc.TABLE_NAME = kcu.TABLE_NAME
               WHERE tc.TABLE_SCHEMA = DATABASE()
                 AND tc.TABLE_NAME = :t
                 AND tc.CONSTRAINT_TYPE = 'PRIMARY KEY'
               ORDER BY kcu.ORDINAL_POSITION";
        $rows = $db->createCommand($sql)->queryAll([':t' => $tableName]);
        $cols = [];
        foreach ($rows as $r) {
            if (!empty($r['COLUMN_NAME'])) {
                $cols[] = $r['COLUMN_NAME'];
            }
        }
        return $cols;
    }

    private function mbStrIreplace($search, $replace, $subject, $enc = 'UTF-8')
    {
        if ($search === '' || $search === null) {
            return $subject;
        }
        $needleLen = function_exists('mb_strlen') ? mb_strlen($search, $enc) : strlen($search);
        if ($needleLen === 0) {
            return $subject;
        }
        $lowerSubject = function_exists('mb_strtolower') ? mb_strtolower($subject, $enc) : strtolower($subject);
        $lowerNeedle  = function_exists('mb_strtolower') ? mb_strtolower($search, $enc) : strtolower($search);
        $result = '';
        $offset = 0;
        while (true) {
            $pos = function_exists('mb_strpos') ? mb_strpos($lowerSubject, $lowerNeedle, $offset, $enc) : strpos($lowerSubject, $lowerNeedle, $offset);
            if ($pos === false) {
                break;
            }
            $result .= (function_exists('mb_substr') ? mb_substr($subject, $offset, $pos - $offset, $enc) : substr($subject, $offset, $pos - $offset)) . $replace;
            $offset = $pos + $needleLen;
        }
        $result .= function_exists('mb_substr') ? mb_substr($subject, $offset, null, $enc) : substr($subject, $offset);
        return $result;
    }
}
