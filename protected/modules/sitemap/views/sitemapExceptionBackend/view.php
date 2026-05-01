<?php
/**
 * Отображение для view:
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
    $model->id,
];

$this->pageTitle = Yii::t('SitemapModule.sitemap', 'Списки исключений - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SitemapModule.sitemap', 'Управление Списками исключений'), 'url' => ['/sitemap/sitemapExceptionBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SitemapModule.sitemap', 'Добавить Список исключений'), 'url' => ['/sitemap/sitemapExceptionBackend/create']],
    ['label' => Yii::t('SitemapModule.sitemap', 'Список исключений') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('SitemapModule.sitemap', 'Редактирование Списка исключений'), 'url' => [
        '/sitemap/sitemapExceptionBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('SitemapModule.sitemap', 'Просмотреть Список исключений'), 'url' => [
        '/sitemap/sitemapExceptionBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('SitemapModule.sitemap', 'Удалить Список исключений'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/sitemap/sitemapExceptionBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('SitemapModule.sitemap', 'Вы уверены, что хотите удалить Список исключений?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SitemapModule.sitemap', 'Просмотр') . ' ' . Yii::t('SitemapModule.sitemap', 'Списка исключений'); ?>        <br/>
        <small>&laquo;<?=  $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'exception_url',
        'status',
    ],
]); ?>
