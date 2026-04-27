<?php
$this->title = Yii::app()->getModule('news')->metaTitle ?: Yii::t('NewsModule.news', 'News');
$this->description = Yii::app()->getModule('news')->metaDescription;
$this->keywords = Yii::app()->getModule('news')->metaKeyWords;

$this->breadcrumbs = [Yii::t('NewsModule.news', 'News')];
?>

    <div class="container">
        <?php $this->widget(
                    'bootstrap.widgets.TbBreadcrumbs',
                    [
                        'links' => $this->breadcrumbs,
                    ]
                );?>
    </div>
    <div class="pageMainContent">
    <div class="container">
    <h1><?= Yii::t('NewsModule.news', 'News') ?></h1>
        <?php $this->widget(
    'bootstrap.widgets.TbListView',
    [
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'summaryText' => "Новости {start}-{end} из {count} ",
        'itemsCssClass'=>'last-news',
        'ajaxUpdate'=>true,
        'enableHistory' => false,
        'pagerCssClass' => 'pagination-box',
        'pager' => [
        'header' => '',
        'lastPageLabel' => '<i class="icon-double_arrow-right" aria-hidden="true"></i>',
        'firstPageLabel' => '<i class="icon-double_arrow-left" aria-hidden="true"></i>',
        'prevPageLabel' => '<i aria-hidden="true"></i>',
        'nextPageLabel' => '<i aria-hidden="true"></i>',
        'maxButtonCount' => 5,
        'htmlOptions' => [
            'class' => 'pagination'
        ],
    ]
]
); ?>
    </div>
</div>
