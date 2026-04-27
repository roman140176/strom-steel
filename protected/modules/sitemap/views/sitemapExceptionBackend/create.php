<?php
/**
 * Отображение для create:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('SitemapModule.sitemap', 'Списки исключений') => ['/sitemap/sitemapExceptionBackend/index'],
    Yii::t('SitemapModule.sitemap', 'Добавление'),
];

$this->pageTitle = Yii::t('SitemapModule.sitemap', 'Списки исключений - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SitemapModule.sitemap', 'Управление Списками исключений'), 'url' => ['/sitemap/sitemapExceptionBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SitemapModule.sitemap', 'Добавить Список исключений'), 'url' => ['/sitemap/sitemapExceptionBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SitemapModule.sitemap', 'Списки исключений'); ?>
        <small><?=  Yii::t('SitemapModule.sitemap', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>