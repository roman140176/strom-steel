<div class="payment d-flex">
    <?php foreach ($model->images as $key => $image): ?>
        <div class="payment__item">
            <?= CHtml::image($image->getImageUrl(),$image->alt) ?>
        </div>
    <?php endforeach ?>
</div>