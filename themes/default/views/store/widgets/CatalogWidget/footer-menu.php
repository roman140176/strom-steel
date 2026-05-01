<?php if ($category) : ?>
  <ul class="menu_footer mf-catalog-menu">
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
      <li id="footerCatalog-<?= $data->id ?>">
        <a href="<?= $link . $data->getCategoryUrl() ?>" <?= $target ?>>
          <?= $data->title ?>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
<?php endif ?>