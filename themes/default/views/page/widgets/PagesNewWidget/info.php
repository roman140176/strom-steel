<div class="info-page-items">
    <?php foreach ($pages as $key => $page): ?>
        <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->slug]) ?>" class="ip__page">
            <div class="ip__image posrel">
                <div class="ip__hover abs">
                <?= CHtml::image($page->getImageUrl(50,50,true,null,"icon")) ?>
                </div>
                <?= CHtml::image($page->getImageUrl(50,50,true,null,"image")) ?>
            </div>
            <div class="ip__name">
                <?= $page->title_short?>
            </div>
        </a>
    <?php endforeach ?>
</div>
