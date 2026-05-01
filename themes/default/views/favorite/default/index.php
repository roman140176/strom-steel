<?php
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->getClientScript()->registerScriptFile(
    Yii::app()->getAssetManager()->publish(
        Yii::getPathOfAlias('application.modules.favorite.view.web') . '/favorite.js'
    ),
    CClientScript::POS_END
);

$this->title = 'Избранные товары';
$this->breadcrumbs = [
    Yii::t("StoreModule.store", "Catalog") => ['/store/category/index'],
    'Избранные товары'
];
?>

<div class="page-content-favorites">
    <div class="container">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="page_title mb30">Избранные товары</h1>


        <?php $this->widget(
            'zii.widgets.CListView', [
                'dataProvider' => $dataProvider,
                'viewData' => [
                    'isdelete' => true
                ],
                'itemView' => '//store/product/_favorite',
                'template' => '
                    {items}
                    {pager}
                ',
                'summaryText' => '',
                'enableHistory' => true,
                'cssFile' => false,
                'itemsCssClass' => 'favorite-box d-grid',
                'pagerCssClass' => 'pagination-box',
                'ajaxUpdate'=>'true',
                'pager' => [
                    'header' => '',
                    'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    'maxButtonCount' => 5,
                    'htmlOptions' => [
                        'class' => 'pagination'
                    ],
                ],
            ]
        ); ?>


    </div>
</div>