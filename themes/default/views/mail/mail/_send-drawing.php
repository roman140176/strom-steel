<?php
/**
 * Шаблон письма: «Прислать чертёж» с главной (модалка #sendDrawingModal).
 *
 * Передаваемые переменные (см. homepage/hp/page.php):
 * @var string      $userName
 * @var string      $userPhone
 * @var string|null $userEmail
 * @var string|null $userComment
 * @var string|null $fileName    — имя прикреплённого файла (сам файл — attachment)
 */

$rows = [
    ['Имя',              $userName],
    ['Телефон',          $userPhone],
    ['E-mail',           $userEmail ?? null],
    ['Комментарий',      $userComment ?? null],
    ['Приложенный файл', $fileName ?? null],
];

$rows = array_values(array_filter($rows, function ($row) {
    return $row[1] !== null && $row[1] !== '';
}));
?>
<h3 style="font-family: Arial, sans-serif; margin: 0 0 12px;">Заявка с чертежом</h3>
<p style="font-family: Arial, sans-serif; margin: 0 0 14px; color:#555">Клиент отправил чертёж через форму на главной странице сайта.</p>
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
  <tbody>
    <?php foreach ($rows as $i => $row) : ?>
      <tr<?= $i % 2 === 0 ? ' style="background: #ececec;"' : '' ?>>
        <td style="padding: 7px 10px; width: 220px; vertical-align: top;"><strong><?= CHtml::encode($row[0]) ?></strong></td>
        <td style="padding: 7px 10px;"><?= nl2br(CHtml::encode($row[1])) ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
