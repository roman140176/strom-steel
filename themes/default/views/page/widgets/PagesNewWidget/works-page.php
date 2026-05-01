<div class="container container-objects container-obj">
  <div class="objects-page">
    <?php foreach ($pages as $key => $page): ?>
      <div class="objects__item">
        <div class="objects__item-flex">
          <div class="object__item_desc">
              <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->slug]) ?>" class="this-page-title">
                <?= $page->title_short?>
              </a>
              <div class="object__item_desc-info">
                <div class="obj-desc"><?= $page->year?></div>
                <div class="desc-flex">
                  <div class="df__item">
                    <div class="df__item-name">Регион объекта:</div>
                    <div class="df__item-text"><?= $page->previewtext?></div>
                  </div>
                  <div class="df__item">
                    <div class="df__item-name">Тип продукции:</div>
                    <div class="df__item-text"><?= $page->promo?></div>
                  </div>
                </div>
              </div>
          </div>
          <a class="object__item_img"  href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->slug]) ?>">
            <?= CHtml::image($page->getImageUrl(528,300,true,null,'icon')) ?>
          </a>
        </div>
      </div>
    <?php endforeach ?>
    <div class="load-more">
        <a href="#" class="obj-load-link orange">
        Показать ещё
        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/reload.svg'); ?>
        </a>
    </div>
  </div>
  <div class="shadow"></div>
</div>
<?php
Yii::app()->clientScript->registerScript("loadMore", "
    $('.objects__item').slice(0,4).show();
    var arr = $('.objects__item').length;
    $('.obj-load-link').on('click',function(e){
        e.preventDefault();
        $('.objects__item:hidden').slice(0,4).slideDown(400);
        $('.ajax-loading').fadeIn(500);
        if($('.objects__item:visible').length == arr){
        $('.obj-load-link').hide();
        }else{
            $('.obj-load-link').show();
        }
        $('.ajax-loading').delay(100).fadeOut(500);
        })
");
 ?>


