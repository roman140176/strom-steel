<div class="container container-services c_service" id="c_service">
  <?php if ($showTitle) : ?>
    <h1 class="page_title">Услуги и сервисы</h1>
  <?php endif; ?>
  <div class="services-wrap">
    <?php foreach ($pages as $key => $page) : ?>
      <a class="services__item" href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => $page->slug]) ?>">
        <div class="services__item_img">
          <?= CHtml::image($page->getImageUrl(0, 0, true, null, 'icon')) ?>
        </div>
        <div class="services__item_name">
          <?= $page->title_short ?>
        </div>
      </a>
    <?php endforeach ?>
  </div>
</div>