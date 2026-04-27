<?php
/** @var application\controllers\DbReplaceController $this */
$request = Yii::app()->request;
$csrfName = $request->csrfTokenName;
$csrfToken = $request->csrfToken;
$actionUrl = Yii::app()->createUrl('/dbReplace/index');
?>
<div class="container" style="max-width: 800px; margin: 30px auto;">
    <h1>Замена подстроки по БД</h1>
    <form method="post" action="<?php echo CHtml::encode($actionUrl); ?>">
        <input type="hidden" name="<?php echo CHtml::encode($csrfName); ?>" value="<?php echo CHtml::encode($csrfToken); ?>" />
        <div class="form-group">
            <label>Искать</label>
            <input class="form-control" type="text" name="from" value="<?php echo isset($from)?CHtml::encode($from):''; ?>" required />
        </div>
        <div class="form-group">
            <label>Заменить на</label>
            <input class="form-control" type="text" name="to" value="<?php echo isset($to)?CHtml::encode($to):''; ?>" />
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="dryRun" value="1" <?php echo !isset($dryRun) || $dryRun ? 'checked' : ''; ?> /> Тестовый запуск (без изменений)
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Запустить</button>
    </form>

    <?php if (!empty($result)) : ?>
        <hr/>
        <h3>Результат</h3>
        <p>Всего изменено строк: <strong><?php echo (int)$result['totalAffected']; ?></strong></p>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Таблица</th>
                    <th>Поле</th>
                    <th>Найдено</th>
                    <th>Изменено</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($result['rows'] as $row): ?>
                <tr>
                    <td><?php echo CHtml::encode($row['table']); ?></td>
                    <td><?php echo CHtml::encode($row['column']); ?></td>
                    <td><?php echo (int)$row['count']; ?></td>
                    <td><?php echo (int)$row['affected']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="alert alert-warning">
            Для безопасности ограничьте доступ к этой странице (например, авторизация, IP-список).
        </div>
    <?php endif; ?>
</div>
