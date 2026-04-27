<div class="price-install">
    <h2 class="page_title pi_title"><?= $model->name?></h2>
    <div class="price-install__wrap">
        <?php foreach ($model->images as $key => $image): ?>
            <div class="piw__item">
                <div class="piw__item-img">
                    <?= CHtml::image($image->getImageUrl(),'') ?>
                </div>
                <div class="piw__item-name">
                    <?= $image->name?>
                </div>
                <div class="piw__item-price">
                    <?= $image->alt?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
