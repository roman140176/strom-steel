<?php if($model->images) : ?>
    <h3><?= $model->name?></h3>
    <div class="stairs-description">
        <?= $model->description?>
    </div>
    <div class="stairs-flex d-flex">
        <?php foreach ($model->images as $key => $image): ?>
            <div class="stairs__item">
                <div class="stairs__head d-flex">
                    <?= $image->name?>
                </div>
                <div class="stairs__img">
                    <?= CHtml::image($image->getImageUrl()) ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif; ?>