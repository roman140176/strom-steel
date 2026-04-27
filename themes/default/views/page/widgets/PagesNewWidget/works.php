<div class="container container-objects">
  <div class="objects objects-carousel">
    <?php foreach ($pages as $key => $page): ?>
      <div class="objects__item">
        <div class="objects__item-flex">
          <div class="object__item_desc">
              <div class="ob__i-head">
                  <h2 class="page_title">
                    <?= $page->parentPage->title_short?>
                  </h2>
                  <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->parentPage->slug]) ?>" class="all-objects">
                    Все объекты
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/or-arr.svg'); ?>
                  </a>
              </div>
              <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->slug]) ?>" class="this-page-title">
                <?php if (!empty($page->under_title)): ?>
                  <?= $page->under_title?>
                  <?php else: ?>
                  <?= $page->title_short?>
                <?php endif ?>
              </a>
              <div class="object__item_desc-info">
                <?php if (!empty($page->short_content)): ?>
                  <div class="obj-desc"><?= $page->short_content?></div>
                  <?php else: ?>
                  <div class="obj-desc"><?= $page->year?></div>
                <?php endif ?>

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
          <div class="object__item_img">
            <img loading="lazy" data-lazy="<?= $page->getImageUrl(528,300,true,null,'icon') ?>"  alt="<?= $page->title_short?>">
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <div class="shadow"></div>
</div>
<style>
  .object__item_desc-info{
    padding-right: 15px;
  }
</style>
<?php Yii::app()->clientScript->registerScript("c_c", "
  $('.df__item-text').each(function(){
    var ul = $(this).find('ul');
    var li = ul.find('li')
    if(li.length>1){
      li.each(function(i,e){
        if(i != 0){
          $(e).hide()
        }
        })
    }
    })

"); ?>

