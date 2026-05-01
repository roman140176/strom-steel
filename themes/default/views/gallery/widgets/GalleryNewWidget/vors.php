<div class="features-grid-wrap">
    <h3 class="features__head"><?= $model->name?></h3>
    <small><strong><?= $model->description?></strong></small>
    <div class="features-grid">
        <?php foreach ($model->images as $key => $item): ?>
            <div class="features__item">
                <div class="feat__name">
                    <?= $item->name?>
                </div>
                <div class="feat__img">
                    <?= CHtml::image($item->getImageUrl(),$item->alt) ?>
                </div>
                <div class="feat__desc">
                    <?= $item->description?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>