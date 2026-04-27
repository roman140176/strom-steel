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
    <h1 class="page_title"><?= $model->title; ?></h1>
    <?= $model->view?>
    <?= $model->body; ?>
    </div>
</div>
