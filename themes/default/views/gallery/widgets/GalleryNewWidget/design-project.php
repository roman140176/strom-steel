<?php if ($model): ?>
    <div class="photos-object">
        <?php foreach ($model->images as $key => $item): ?>
        <a class="photos-object-item" href="<?= $item->getImageUrl()?>" data-fancybox="obj-<?= $model->id?>">
            <div class="ph__item posrel dsg">
                <div class="glass abs">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
                <?= CHtml::image($item->getImageUrl(320,240,true)) ?>
            </div>
        </a>
        <?php endforeach ?>
    </div>
<?php endif ?>