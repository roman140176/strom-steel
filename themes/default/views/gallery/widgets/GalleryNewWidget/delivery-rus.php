<div class="delivery-rus">
    <div class="delivery-rus__name"><?= $model->name?></div>
    <?php foreach ($model->images as $key => $image): ?>
        <div class="delivery-rus__item">
            <div class="delivery-rus__item-img">
                <picture>
                    <source data-webp="<?= $image->getImageUrlWebp(500,333,true)?>"  type="image/webp">
                    <img data-src="<?= $image->getImageUrl(500,333,true)?>" alt="">
                </picture>
            </div>
            <div class="delivery-rus__item-desc">
                <?= $model->description?>
            </div>
        </div>
    <?php endforeach ?>
</div>
