<div class="category-item" id="it-<?= $data['id'] ?>">
  <?php
  $link = '';
  $target = '';
  switch ($data['id']) {
    case 17:
      $link = 'https://strom-trade.ru';
      $target = 'target="_blank"';
      break;
    default:
      $link = '';
      $target = '';
  }
  ?>
  <div class="category-item_info">
    <?php if (!empty($data['svg_code'])) : ?>
      <a href="<?= $link . $data['url']; ?>" <?= $target ?> class="category-svg" aria-label="<?= CHtml::encode($data['label']); ?>">
        <?= $data['svg_code'] ?>
      </a>
    <?php elseif ($data['icon']) : ?>
      <div class="category-icon">
        <a href="<?= $link . $data['url']; ?>" <?= $target ?>>
          <img src="<?= $data['icon']; ?>" alt="<?= $data['label']; ?>" title="<?= $data['label']; ?>" class="mc-img" />
          <img src="<?= $data['thumbnale']; ?>" alt="<?= $data['label']; ?>" title="<?= $data['label']; ?>" class="mh-img" />
        </a>
      </div>
    <?php endif; ?>
    <a href="<?= $link . $data['url']; ?>" class="category-item-title" <?= $target ?>><?= CHtml::encode($data['label']); ?></a>
  </div>
  <div class="category-item__children">
    <div class="category-children">
      <?php foreach ($data['children'] as $key => $child) : ?>
        <?php if ($child->status == StoreCategory::STATUS_DRAFT) continue; ?>
        <a href="<?= $link . $child->getCategoryUrl() ?>" <?= $target ?>><span><?= $child->name ?></span></a>
      <?php endforeach ?>
    </div>
  </div>
</div>
<style>
  .category-icon .mc-img{
    mix-blend-mode: luminosity;
  }
</style>