<?php if ($category) : ?>
  <!-- <div class="catalog_title" style="display: none"><span>Каталог</span></div> -->
  <div class="catalog-menus">
    <?php foreach ($category as $key => $data) : ?>
      <?php
      $link = '';
      $target = '';
      switch ($data->id) {
        case 17:
          $link = 'https://strom-trade.ru';
          $target = 'target="_blank"';
          break;
        case 22:
          $link = 'https://strom-trade.ru';
          $target = 'target="_blank"';
          break;
        default:
          $link = '';
          $target = '';
      }
      ?>
      <a class="catalog-menus__item" href="<?= $link . $data->getCategoryUrl(); ?>" id="cl-<?= $data->id ?>" <?= $target ?>>
        <span class="catalog-menus__img">
          <?php if ($data->image) : ?>
            <?= CHtml::image($data->getImageUrl(0, 0, true), ''); ?>
          <?php endif; ?>

        </span>
        <span class="catalog-menus__name">
          <?= $data->name; ?>
        </span>
      </a>
    <?php endforeach; ?>
    <a class="catalog-menus__item" href="/store">
      <span class="catalog-menus__img">
        <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/all.png', 'Каталог'); ?>
      </span>
      <span class="catalog-menus__name">
        Вся продукция
      </span>
    </a>
  </div>
<?php endif; ?>