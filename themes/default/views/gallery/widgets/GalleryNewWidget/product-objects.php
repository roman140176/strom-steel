<?php if ($model): ?>
    <div class="photos-object">
        <?php foreach ($model->images as $key => $item): ?>
        <a class="photos-object-item" data-vis="<?= $item->alt?>" href="<?= $item->getImageUrl()?>" data-fancybox="obj-<?= $model->id?>">
            <div class="ph__item product__ph posrel">
                <?= CHtml::image($item->getImageUrl(320,240,true)) ?>
                <i class="abs fa fa-search-plus" aria-hidden="true"></i>
            </div>
        </a>
        <?php endforeach ?>
    </div>
<?php endif ?>