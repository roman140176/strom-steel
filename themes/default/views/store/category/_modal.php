<?php
    $mainAssets = Yii::app()->getTheme()->getAssetsUrl();

    // Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/store-frontend.css');
    // Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');
    /* @var $category StoreCategory */

    $this->title =  $category->getMetaTitle();
    $this->description = $category->getMetaDescription();
    $this->keywords =  $category->getMetaKeywords();
    $this->canonical = $category->getMetaCanonical();

    $this->breadcrumbs = [Yii::t("StoreModule.store", "Catalog") => ['/store/category/index']];

    $this->breadcrumbs = array_merge(
        $this->breadcrumbs,
        $category->getBreadcrumbs(false)
    );

?>

<div class="page-content category-content">
    <div class="container">
        <div class="catalog-content accordion-content<?= ($dataProvider->itemCount) ? '' : 'hidden'; ?>">
            <div class="catalog-content__sidebar">
                <div class="fix-close-wrap">
                        <div class="fix-sidebar-close"></div>
                    </div>
                <div class="sidebar-box">
                    <div class="sidebar-box__close"><div></div></div>
                    <?php //фильтры товаров ?>
                    <form id="store-filter" name="store-filter" method="get" action="<?= Yii::app()->createUrl('/store/category/view', ['path' => $category->path, 'isModel' => true]) ?>">
                        <div class="filter-content">
                            <?php if (count($category->getProducts())>1): ?>
                                <?php if (!empty($category->children)): ?>
                                    <div class="filter-block filter-div">
                                        <div class="filter-block__header">
                                            <span class="cat-name"><?= $category->getTitle() ?></span>
                                        </div>
                                        <div class="filter-block__body">
                                            <div class="filter-block__content">
                                                <?php $this->widget('application.modules.store.widgets.filters.CategoryFilterWidget',[
                                                    'view' => 'category-filter',
                                                    'parent_id' => $category->id
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($category->getCountNotInStock() > 0): ?>
                                    <div class="filter-block filter-div">
                                        <div class="filter-block__header">
                                         <span class="cat-name">Наличие</span>
                                     </div>
                                     <div class="filter-block__body">
                                        <div class="filter-block__content">
                                            <?= CHtml::checkBoxList('stock', !empty($_GET['stock']) ? $_GET['stock'] : [], Product::model()->getInStockList()); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php $this->widget('application.modules.store.widgets.filters.PriceFilterWidget'); ?>

                            <?php $this->widget('application.modules.store.widgets.filters.FilterBlockWidget',[
                                'category' => $category,
                            ]); ?>

                            <?php $this->widget('application.modules.store.widgets.filters.ProducerCityFilterWidget',[
                                'category' => $category,
                            ]); ?>
                            <?php $this->widget('application.modules.store.widgets.filters.ProducerFilterWidget',[
                                'category' => $category,
                            ]); ?>

                            <div class="filter-block filter-button-block">
                                <a href="#" class="load-link">
                                    Ещё фильтры
                                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/refresh.svg'); ?>
                                </a>
                            </div>
                            <div class="filter-mobile-button">
                                    <button class="but-filter">применить</button>
                                </div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
            <div class="catalog-content__content">
                    <?php if (!empty($category->children)): ?>
                        <div class="second-level-categories">
                            <?php $this->widget('application.modules.store.widgets.CatalogListWidget',[
                                'category_id' => $category->id,
                                'view' => 'category-top'
                            ]); ?>
                        </div>
                    <?php endif ?>
                    <div class="selected-filters"></div>
                    </form>

                        <?php if (count($category->getProducts())>0): ?>
                            <?php
                            $this->widget(
                                'application.components.MyListView',
                                [
                                    'dataProvider' => $dataProvider,
                                    'id' => 'product-box',
                                    'itemView' => '//store/product/'.$this->storeItem,
                                    'emptyText'=>'В данной категории нет товаров.',
                                    'summaryText'=>"{count} тов.",
                                    'template'=>'
                                    {controls}
                                    {items}
                                    <div class="product-nav">
                                    {pager}
                                    {countValue}
                                    {countPage}
                                    </div>
                                    ',
                                    'countProduct' => count($category->getProducts()),
                                    'sorterDropDown' => [
                                        'name' => 'По названию',
                                        'price_result' => 'Дешевле',
                                        'price_result.desc' => 'Дороже',
                                    ],
                                    'sorterClassUl' => 'sort-box__list',
                                    'sorterHeader' => 'Сортировка',
                                    'itemsCssClass' => Yii::app()->getController('front')->storeItem == "_item-list" ? "product-list horisontal" : "product-list",
                                    'htmlOptions' => [
                                        // 'class' => 'product-box'
                                    ],
                                    'ajaxUpdate'=>true,
                                    'enableHistory' => false,
                                    'pagerCssClass' => 'pagination-box',
                                    'viewData' => [
                                        'isModel' => $isModel,
                                    ],
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
                            <?php else: ?>
                                В данной категории пока нет товаров
                            <?php endif ?>
                        </div>

        </div>

    </div>
</div>

<?php
Yii::app()->clientScript->registerScript("color", "
    function rgb2hsl(HTMLcolor) {
    r = parseInt(HTMLcolor.substring(0,2),16) / 255;
    g = parseInt(HTMLcolor.substring(2,4),16) / 255;
    b = parseInt(HTMLcolor.substring(4,6),16) / 255;
    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;
    if (max == min) {
        h = s = 0;
    } else {
        var d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch (max) {
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h /= 6;
    }
    return [h, s, l]; // H - цветовой тон, S - насыщенность, L - светлота
}

$('.color-item').on('click',function(){
    var color = $(this).attr('style').replace('background:#','',$(this).attr('style'));
     e = rgb2hsl(color);
    if ((e[0]<0.55 && e[2]>=0.5) || (e[0]>=0.55 && e[2]>=0.75)) {

        $(this).find('.color-label').css({
            backgroundImage:\"url('{$mainAssets}/images/checkedb.svg')\"
            });
    } else {

        $(this).find('.color-label').css({
            backgroundImage:\"url('{$mainAssets}/images/checkedw.svg')\"
            });
    }


})

");
 ?>
