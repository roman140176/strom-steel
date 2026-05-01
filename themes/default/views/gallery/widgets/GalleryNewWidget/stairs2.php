<?php if($model->images) : ?>
    <div class="stairs-flex d-flex">
        <?php foreach ($model->images as $key => $image): ?>
            <div class="multi_stairs__item">
                <div class="stairs__head multi_stairs__head d-flex">
                    <?= $image->name?>
                </div>
                <div class="multi_stairs__img">
                    <?= CHtml::image($image->getImageUrl()) ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif; ?>