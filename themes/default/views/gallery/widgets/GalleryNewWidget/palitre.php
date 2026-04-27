<div class="category__detail-wrap">
    <div class="m_descs">
        <?= $model->description?>
    </div>
    <h2 class="page-title">
        <?= $model->name?>
    </h2>
    <div class="palitre-flex">
        <?php foreach ($model->images as $key => $image): ?>
            <div class="palitre__item">
                <div class="palitre__name"><?= $image->name?></div>
                <div class="paliter__img">
                    <?= CHtml::image($image->getImageUrl(),$image->alt) ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>