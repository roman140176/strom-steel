<?php $mainAssets = Yii::app()->getTheme()->getAssetsUrl();?>
<div class="container d-flex container-dillers">
    <div class="dillers__item-left">
        <div class="dillers__item-left_small"><?= $pages->under_title?></div>
        <h2 class="page_title dillers-title"><?= $pages->title_short?></h2>
        <div class="dillers__item-left_txt">
            <?= $pages->short_content?>
        </div>
        <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$pages->slug]) ?>" class="b-red dillers-link">
         Узнать больше
         <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/link-arrow.svg'); ?>
        </a>
    </div>
    <div class="dillers__item-right">
        <picture>
            <source data-webp="<?= $pages->getImageUrlWebp(807,505,true,null,'image')?>"  type="image/webp">
            <img data-src="<?= $pages->getImageUrl(807,505,true,null,'image')?>" alt="<?= $pages->title_short?>">
        </picture>
        <div class="abs-top">
            <?= CHtml::image($mainAssets . '/images/logoimg.png',$pages->title_short,['class' => 'abs-big']) ?>
            <?= CHtml::image($mainAssets . '/images/tright.png',$pages->title_short,['class' => 'abs-small']) ?>
        </div>
        <div class="abs-bottom">
            <?= CHtml::image($mainAssets . '/images/bleft.png') ?>
            <?= CHtml::image($mainAssets . '/images/bright.png') ?>
        </div>
    </div>
</div>
