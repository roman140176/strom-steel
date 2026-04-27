<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
Yii::import('application.modules.gallery.models.*');
?>
<div class="pageMainContent">
    <div class="container breadcrumbs-container">
                <?php $this->widget(
                    'bootstrap.widgets.TbBreadcrumbs',
                    [
                        'links' => $this->breadcrumbs,
                    ]
                );?>
    </div>
    <div class="container">
    <h1 class="page_title"><?= $model->title_short; ?></h1>
    <div class="obj-region"><strong>Регион:</strong> <?= str_replace('<br>','',$model->previewtext)?></div>
    <div class="obj-desc"><strong>Описание объекта:</strong> <?= $model->year?></div>
    <div class="obj-type"><strong>Тип продукции:</strong> <?= $model->promo?></div>
    <?php if (!empty($model->bonus)): ?>
        <br>
        <div class="obj-links-list">
            <?= $model->bonus?>
        </div>
    <?php endif ?>
    <h3 class="obj-gallery-title">Фото объекта</h3>
    <?php $this->widget('application.modules.gallery.widgets.GalleryNewWidget',[
        'view'=>'object',
        'name' => $model->title
        ]); ?>
    </div>
</div>
