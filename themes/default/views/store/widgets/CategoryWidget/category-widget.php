<?php if ($tree) : ?>
  <!-- <div class="catalog_title" style="display: none"><span>Каталог</span></div> -->
  <ul class="catalog-tree">
    <?php foreach ($tree as $key => $data) : ?>
      <?php
      $link = '';
      $target = '';
      switch ($data['id']) {
        case 17:
          $link = 'https://stromsteel.ru';
          $target = 'target="_blank"';
          break;
        case 22:
          $link = 'https://stromsteel.ru';
          $target = 'target="_blank"';
          break;
        default:
          $link = '';
          $target = '';
      }
      ?>
      <li class="item_<?= $data['id'] ?>">
        <a href="<?= $link . $data['url']; ?>" id="sl-<?= $data['id'] ?>" <?= $target ?>>
          <?= $data['label']; ?>
        </a>
        <?php if (!empty($data['children'])) : ?>
          <ul class="sl-catalog">
            <?php foreach ($data['children'] as $key => $child) : ?>
              <li class="item_<?= $child->id ?>">
                <a href="<?= $link . $child->getCategoryUrl() ?>" id="sl-<?= $child['id'] ?>" <?= $target ?>>
                  <?= $child->name; ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </li>
    <?php endforeach; ?>

  <?php endif; ?>