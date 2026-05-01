<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

/* @var $category StoreCategory */

$this->title = Yii::app()->getModule('store')->metaTitle ?: Yii::t('StoreModule.store', 'Catalog');
$this->description = Yii::app()->getModule('store')->metaDescription;
$this->keywords = Yii::app()->getModule('store')->metaKeyWords;

$this->breadcrumbs = [Yii::t("StoreModule.store", "Catalog")];
?>
<div class="page-content">
<div class="container">
    <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="page_title store-title">Каталог товаров</h1>
   <div class="catalog-page">
            <?php $this->widget(
            'bootstrap.widgets.TbListView',
            [
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'summaryText' => '',
                'cssFile' => false,
                'itemsCssClass' => 'categories-items',
                'htmlOptions' => [
                    'id' => 'catalog-main',
                    'class' => 'catalog-box'
                ],
                            'ajaxUpdate'=>true,
                            'enableHistory' => false,
                            'pagerCssClass' => 'pagination-box-category',
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
   <?php $this->renderPartial('//layouts/_form'); ?>
</div>
</div>
<?php
Yii::app()->clientScript->registerScript("column", "

    $('.wcatalog li a').on('click',function(e){
        if($(this).parent('li').children('.subCatalog').length > 0){
            e.preventDefault();
        $(this).parent('li').find('.subCatalog').slideToggle(400);
        }
        });
         function equalHeight(group) {
        var tallest = 0;
        group.each(function() {
            thisHeight = $(this).height();
            if(thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }
    $(document).ready(function(){
        equalHeight($('.category-item_info'));
    });

");
 ?>

 <style>
    .categories-items{
        grid-template-columns: repeat(2,1fr);
        grid-row-gap: 20px;
        grid-column-gap: 20px;
    }
    .category-children{
        display: flex;
        flex-flow:column;
    }
    .category-item_info{
        width: 280px;
    }
    .category-item__children{
        width: calc(100% - 280px);
    }
    .category-children a{
        width: 100%!important;
    }
    .category-children a span {
        max-width: 100%;
    }
    @media (max-width: 1250px) {
        .categories-items{
            grid-template-columns: repeat(4,1fr);
            grid-row-gap: 16px;
            grid-column-gap: 16px;
        }
        .category-item_info{
            width: 100%;
        }
    }
    @media (max-width: 991px) {
        .categories-items{
            grid-template-columns: repeat(4,1fr);
            grid-row-gap: 8px;
            grid-column-gap: 8px;
        }        
    }
    @media (max-width: 850px) {
        .categories-items{
            grid-template-columns: repeat(2,1fr);
            grid-row-gap: 16px;
            grid-column-gap: 16px;
        }        
    }
    @media (max-width: 450px) {
        .categories-items{
            grid-template-columns: 100%;
            grid-row-gap: 16px;
            grid-column-gap: 0;
        }        
    }
 </style>