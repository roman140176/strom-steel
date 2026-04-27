<?php
/**
 * Шаблон письма: расчёт стоимости лазерной резки.
 *
 * Передаваемые переменные (см. lazernaya-rezka.php):
 * @var string      $userName
 * @var string      $userPhone
 * @var string|null $userEmail
 * @var string      $metalType
 * @var string      $metalThickness
 * @var string      $metalMeters
 * @var string      $metalBurns
 * @var string|null $fileName       — имя приложенного файла (отображается в письме)
 */

$rows = [
    ['Имя',              $userName],
    ['Телефон',          $userPhone],
    ['E-mail',           $userEmail ?? null],
    ['Тип металла',      $metalType],
    ['Толщина (мм)',     $metalThickness],
    ['Кол-во метров',    $metalMeters],
    ['Кол-во прожигов',  $metalBurns],
    ['Приложенный файл', $fileName ?? null],
];

// Рендерим только не-пустые поля.
$rows = array_values(array_filter($rows, function ($row) {
    return $row[1] !== null && $row[1] !== '';
}));
?>
<h3 style="font-family: Arial, sans-serif; margin: 0 0 12px;">Заявка на расчёт лазерной резки</h3>
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
  <tbody>
    <?php foreach ($rows as $i => $row) : ?>
      <tr<?= $i % 2 === 0 ? ' style="background: #ececec;"' : '' ?>>
        <td style="padding: 7px 10px; width: 220px;"><strong><?= CHtml::encode($row[0]) ?></strong></td>
        <td style="padding: 7px 10px;"><?= CHtml::encode($row[1]) ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
