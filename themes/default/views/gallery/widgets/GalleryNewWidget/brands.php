
    <div class="srtf d-flex">
        <?php foreach ($model->images as $key => $item): ?>
            <a href="<?= $item->getImageUrl() ?>" data-fancybox="group-<?= $model->id?>">
                <div class="srtf__item posrel">
                    <div class="span-plus">+</div>
                    <?= CHtml::image($item->getImageUrl(400,566,true),$item->alt) ?>
                </div>
            </a>
        <?php endforeach ?>
    </div>

