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
<div class="articles-flex">
    <div class="articles-flex__sidebar">
        <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
            'name' => 'saydbar',
            'view' => 'sidebar',
            'level' => 3
            ]); ?>

    </div>
    <div class="articles-flex__content">
        <?php if (!empty($model->bonus)): ?>
            <blockquote>
                <?= $model->bonus?>
            </blockquote>
        <?php endif ?>
        <?php if (!empty($model->childPages)): ?>
            <?php $this->widget('application.modules.page.widgets.PagesWidget',[
                'parent_id' => $model->id,
                 'isUseDataProvider' => 1,
                 'view' => 'blog-child',
                 'pageSize' =>6
            ]); ?>
        <?php endif ?>
        <?= $model->body; ?>
    </div>
</div>
</div>
</div>
