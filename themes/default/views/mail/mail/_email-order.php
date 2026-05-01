<table style="width: 100%;">
    <tbody>
        <?php foreach ($model->attributes as $key => $data) : ?>
            <?php if (!$data) {
                continue;
            } ?>
            <tr style="background: #ececec;">
                <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel($key)?></strong></td>
                <td style="padding: 7px 10px;"><?= $data; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
