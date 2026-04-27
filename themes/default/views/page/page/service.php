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
    <h1 class="page_title"><?= $model->title_short; ?></h1>
    <div class="services-page">
        <div class="services-page__sidebar">
            <?php $parent = $model->parentPage->childPages ?>
            <div class="parent-name"><?= $model->parentPage['title']?></div>
            <ul class="service-menu">
                <?php foreach ($parent as $key => $page): ?>
                    <li>
                        <a href="<?= $page->slug?>" <?= $_GET['slug'] === $page->slug ? 'class="active"' : ''?>>
                            <span><?= $page->title?></span>
                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/levels.svg'); ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="services-page__content">
        <?= $model->body; ?>
        </div>
    </div>
    </div>
</div>
