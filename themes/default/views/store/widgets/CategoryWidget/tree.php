<?php

function renderMenu($items, $level = 0, $parent = null)
{
  $menu = '';

  if ($level == 1) {
    $menu .= CHtml::openTag('div', ['class' => 'menu-catalog-submenu']);
    $menu .= CHtml::openTag('div', ['class' => 'menu-catalog-submenu__header']);
    $menu .= CHtml::link($parent['label'], $parent['url']);
    $menu .= CHtml::closeTag('div');
  }

  $menu .= CHtml::openTag('ul');

  foreach ($items as $item) {
    $liClass = !empty($item['items']) && $level == 0 ? ['class' => 'has-submenu'] : [];

    $menu .= CHtml::openTag('li', $liClass);
    $menu .= CHtml::link($item['label'], ($item['id'] == 17 || $parent['id'] == 17 && $item['id'] != 20) ? 'https://strom-trade.ru' . $item['url'] : $item['url'], [
      'target' => ($item['id'] == 17 || $parent['id'] == 17 && $item['id'] != 20) ? '_blank' : '_self'
    ]);
    if (!empty($item['items'])) {
      $parent = $item;
      $menu .= renderMenu($item['items'], $level + 1, $parent);
    }

    $menu .= CHtml::closeTag('li');
  }

  $menu .= CHtml::closeTag('ul');

  if ($level == 1) {
    $menu .= CHtml::closeTag('div');
  }

  return $menu;
}

?>

<div class="menucatalog abs" id="menu-catalog">
  <?= renderMenu($tree); ?>
</div>