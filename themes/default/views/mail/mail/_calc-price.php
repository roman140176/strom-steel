<table style="width: 100%;">
  <tbody>
    <tr style="background: #ececec;">
      <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('name') ?></strong></td>
      <td style="padding: 7px 10px;"><?= $model->name; ?></td>
    </tr>
    <tr>
      <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('phone') ?></strong></td>
      <td style="padding: 7px 10px;"><?= $model->phone; ?></td>
    </tr>
    <tr style="background: #ececec;">
      <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('email') ?></strong></td>
      <td style="padding: 7px 10px;"><?= $model->email; ?></td>
    </tr>

    <tr style="background: #ececec;">
      <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('type') ?></strong></td>
      <td style="padding: 7px 10px;"><?= $model->type; ?></td>
    </tr>

    <tr style="background: #ececec;">
      <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('thickness') ?></strong></td>
      <td style="padding: 7px 10px;"><?= $model->thickness; ?></td>
    </tr>

    <tr style="background: #ececec;">
      <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('meters') ?></strong></td>
      <td style="padding: 7px 10px;"><?= $model->meters; ?></td>
    </tr>

    <tr style="background: #ececec;">
      <td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('burning') ?></strong></td>
      <td style="padding: 7px 10px;"><?= $model->burning; ?></td>
    </tr>
  </tbody>
</table>