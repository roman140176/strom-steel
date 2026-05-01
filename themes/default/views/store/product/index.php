<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

/* @var $category StoreCategory */

$this->title = Yii::app()->getModule('store')->metaTitle ?: Yii::t('StoreModule.store', 'Catalog');
$this->description = Yii::app()->getModule('store')->metaDescription;
$this->keywords = Yii::app()->getModule('store')->metaKeyWords;

$this->breadcrumbs = [Yii::t("StoreModule.store", "Catalog")];
?>

<div class="container">
    <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
    <h1 class="page_title">Каталог продукци</h1>
   <div class="catalog-page">
     <div class="fix-menu">
         <div class="fixed-menu__button">
             <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/ar.svg'); ?>
             <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cb.svg'); ?>
         </div>
         <span>Меню Категорий</span>
     </div>
       <div class="categories-menu m_index">
            <div class="fix-close"></div>
            <?php $this->widget('application.modules.store.widgets.CategoryWidget',['depth'=>3]); ?>
       </div>

            <?php $this->widget('application.modules.store.widgets.CatalogWidget',[
                    'view'=>'catalog-view'
                ]); ?>

   </div>
   <?php $this->renderPartial('//layouts/_form'); ?>
</div>
<?
Yii::app()->clientScript->registerScript("column", "

    $('.wcatalog li a').on('click',function(e){
        if($(this).parent('li').children('.subCatalog').length > 0){
            e.preventDefault();
        $(this).parent('li').find('.subCatalog').slideToggle(400);
        }
        })

");
 ?>