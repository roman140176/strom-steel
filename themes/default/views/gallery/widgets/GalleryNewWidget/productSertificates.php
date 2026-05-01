<?php if ($model): ?>
    <div class="gallery-sertificates d-flex" style="padding-top: 30px">
    <?php foreach ($model->images as $key => $photo): ?>
            <div class="gs__item">
                <a class="gs__img" data-fancybox="cat-<?= $category->id?>" href="<?= $photo->getImageUrl()?>">
                    <?= CHtml::image($photo->getImageUrl()) ?>
                </a>
                <div class="gs__title">
                    <?= $photo->name?>
                </div>
            </div>
    <?php endforeach ?>
</div>
<?php endif ?>

