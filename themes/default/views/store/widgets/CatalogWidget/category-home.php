<div class="container home-catalog-container">
  <h1 class="page_title">Каталог продукции</h1>
  <div class="catalog-on-home">
    <?php foreach ($category as $key => $data) : ?>
      <?php
      $link = '';
      $target = '';
      switch ($data->id) {
        case 17:
          $link = 'https://strom-trade.ru';
          $target = 'target="_blank"';
          break;
        default:
          $link = '';
          $target = '';
      }
      ?>
      <a class="catalog-on-home__item" id="itemCatalog-<?= $data->id ?>" href="<?= $link . $data->getCategoryUrl() ?>" <?= $target ?>>
        <div class="coh__item-img">
          <?= CHtml::image($data->getImageUrl(), '', ['loading'=>'lazy']) ?>
          <div class="coh__item-img__absolute">
            <?= CHtml::image($data->getImageUrl(0, 0, true, null, 'thumbnale'), '', ['loading'=>'lazy']) ?>
          </div>
        </div>
        <div class="coh__item-name">
          <span><?= $data->getTitle() ?></span>
        </div>

      </a>
    <?php endforeach ?>
  </div>
</div>