<?php
/**
 * Отображение для index:
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
    Yii::t('SitemapModule.sitemap', 'Управление'),
];

$this->pageTitle = Yii::t('SitemapModule.sitemap', 'Списки исключений - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SitemapModule.sitemap', 'Управление Списками исключений'), 'url' => ['/sitemap/sitemapExceptionBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SitemapModule.sitemap', 'Добавить Список исключений'), 'url' => ['/sitemap/sitemapExceptionBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SitemapModule.sitemap', 'Списки исключений'); ?>
        <small><?=  Yii::t('SitemapModule.sitemap', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('SitemapModule.sitemap', 'Поиск Списков исключений');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('sitemap-exception-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('SitemapModule.sitemap', 'В данном разделе представлены средства управления Списками исключений'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'sitemap-exception-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            'exception_url',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/sitemap/sitemapExceptionBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Page::STATUS_PUBLISHED => ['class' => 'label-success'],
                    Page::STATUS_DRAFT => ['class' => 'label-danger'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
