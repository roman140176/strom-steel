<?php

class DbReplaceCommand extends CConsoleCommand
{
    public $dryRun = true;

    public function run($args)
    {
        if (count($args) < 2) {
            echo "Usage: yiic dbreplace <from> <to> [--dryRun=1|0]\n";
            return 1;
        }
        $from = array_shift($args);
        $to = array_shift($args);
        foreach ($args as $arg) {
            if (strncmp($arg, '--dryRun=', 9) === 0) {
                $this->dryRun = (bool)(int)substr($arg, 9);
            }
        }
        $db = Yii::app()->db;
        $driver = $db->getDriverName();
        if ($driver !== 'mysql') {
            echo "Only MySQL is supported.\n";
            return 1;
        }
        $columns = $this->getMysqlTextColumns($db);
        $like = '%' . $from . '%';
        $total = 0;
        foreach ($columns as $c) {
            $table = $this->quoteTable($db, $c['TABLE_NAME']);
            $col = $this->quoteColumn($db, $c['COLUMN_NAME']);
            $expr = "REPLACE($col, :from, :to)";
            $lenGuard = '';
            if (in_array($c['DATA_TYPE'], array('char','varchar'), true) && !empty($c['CHARACTER_MAXIMUM_LENGTH'])) {
                $lenGuard = " AND CHAR_LENGTH($expr) <= " . (int)$c['CHARACTER_MAXIMUM_LENGTH'];
            }
            $sqlCount = "SELECT COUNT(*) FROM $table WHERE $col LIKE :like$lenGuard";
            $sqlUpdate = "UPDATE $table SET $col = $expr WHERE $col LIKE :like$lenGuard";
            $paramsCount = array(':like'=>$like);
            if ($lenGuard !== '') {
                $paramsCount[':from'] = $from;
                $paramsCount[':to'] = $to;
            }
            $paramsUpdate = array(':from'=>$from,':to'=>$to,':like'=>$like);
            $cnt = (int)$db->createCommand($sqlCount)->queryScalar($paramsCount);
            if ($this->dryRun) {
                if ($cnt>0) echo "dry-run: {$c['TABLE_NAME']}.{$c['COLUMN_NAME']} -> $cnt\n";
                continue;
            }
            if ($cnt>0) {
                $affected = (int)$db->createCommand($sqlUpdate)->execute($paramsUpdate);
                $total += $affected;
                echo "updated: {$c['TABLE_NAME']}.{$c['COLUMN_NAME']} -> $affected\n";
            }
        }
        echo "total: $total\n";
        return 0;
    }

    private function getMysqlTextColumns(CDbConnection $db)
    {
        $sql = "SELECT TABLE_NAME,COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND DATA_TYPE IN ('char','varchar','text','mediumtext','longtext')";
        return $db->createCommand($sql)->queryAll();
    }

    private function quoteTable(CDbConnection $db, $name)
    {
        return $db->quoteTableName($name);
    }

    private function quoteColumn(CDbConnection $db, $name)
    {
        return $db->quoteColumnName($name);
    }
}
