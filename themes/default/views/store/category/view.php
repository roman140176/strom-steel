<?php
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();


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

<div class="wrap-category-sections">
  <div class="container">
    <?php $this->widget('application.components.MyTbBreadcrumbs', [
      'links' => $this->breadcrumbs,
    ]); ?>
    <h1 class="page_title"><?= CHtml::encode($category->title); ?></h1>
    
  </div>
</div>
<div class="switcher-contents">
  <div class="container swithcer-nav">
    <div class="sn__item active" data-switch="#production"><span>Продукция</span></div>
    <?php if (!empty($category->description) || !empty($category->linked_id) || (int)$category->id == 15) : ?>
      <div class="sn__item" data-switch="#category-deteals">
        <?php if (!empty($category->desc_title)) : ?>
          <span><?= $category->desc_title ?></span>
        <?php else : ?>
          <span>Подробнее</span>
        <?php endif ?>
      </div>
    <?php
    endif;
    ?>
    <?php if (!empty($category->sertificate)) : ?>
      <div class="sn__item" data-switch="#category-sertificates"><span>Сертификаты</span></div>
    <?php
    endif;
    ?>
  </div>
</div>


<div class="page-content category-content active" id="production">
  <div class="catalog-content">
    <!--  -->
    <div class="catalog-content__content">
      <?php if (!empty($category->children)) : ?>
        <div class="container">
          <!-- <div class="doter-cats">
                            <span>Дочерние категории</span>
                        </div> -->
          <div class="second-level-categories">
            <div class="csl__item cls_main">
              <?php if (!empty($category->svg_code)) : ?>
                <div class="csl__svg" aria-hidden="true"><?= $category->svg_code ?></div>
              <?php else : ?>
                <div class="csl__img">
                  <?= CHtml::image($category->getImageUrl(164, 125, true, null, 'image', '', ['class' => 'main_img'])) ?>
                  <div class="csl__img_absolute">
                    <?= CHtml::image($category->getImageUrl(164, 125, true, null, 'thumbnale', '', ['class' => 'thumb_img'])) ?>
                  </div>
                </div>
              <?php endif ?>
              <div class="csl__name">
                <?= $category->name ?>
              </div>
            </div>
            <?php $this->widget('application.modules.store.widgets.CatalogListWidget', [
              'category_id' => $category->id,
              'view' => 'category-top',
            ]); ?>
          </div>
        </div>
      <?php endif ?>



      <section class="filters-section">
        <div class="container posrel">
          <div class="but-menu-filter">
            <a class="but but-green" href="#"><i class="fa fa-filter" aria-hidden="true"></i><span>Фильтры</span>
            </a>
          </div>
          <div class="catalog-content__sidebar<?= $dataProvider->itemCount <= 1 ? ' hidden' : '' ?>"">
                                <!-- <div class=" fix-close-wrap">
            <div class="fix-sidebar-close"></div>
          </div> -->
          <div class="sidebar-box">
            <div class="filters-loading" data-filters-loading>
              <div class="filters-loading__inner">
                <span class="filters-loading__text">Готовим фильтры…</span>
              </div>
            </div>
            <div class="sidebar-box__close">
              <div></div>
            </div>

            <form id="store-filter" name="store-filter" method="get" action="<?= Yii::app()->createUrl('/store/category/view', ['path' => $category->path]) ?>">
              <div class="filter-content">
                <?php if (count($category->getProducts()) > 1) : ?>
                  <?php if (!empty($category->children)) : ?>
                    <div class="filter-block filter-div filter-cat">
                      <div class="atr-name">Выбор категории:</div>
                      <div class="filter-block__header">
                        <div class="cat-name"><small>Выбрать</small></div>
                      </div>
                      <div class="filter-block__body">
                        <div class="filter-block__content">
                          <?php $this->widget('application.modules.store.widgets.filters.CategoryFilterWidget', [
                            'view' => 'category-filter',
                            'parent_id' => $category->id
                          ]); ?>
                        </div>
                        <div class="filter-block__but">
                          <input type="submit" value="Применить" class="but but-filter" />
                        </div>
                      </div>
                    </div>
                  <?php endif ?>
                  <?php if ($category->getCountNotInStock() > 0) : ?>
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

                  <?php $this->widget('application.modules.store.widgets.filters.PriceFilterWidget', [
                    'category_id' => $category->id
                  ]); ?>

                  <?php $this->widget('application.modules.store.widgets.filters.FilterBlockWidget', [
                    'category' => $category,
                  ]); ?>

                <?php endif ?>

              </div>

              <div class="fbc-wrap">
                <div class="fbc_head atr-name">Показывать только:</div>
                <div class="fbc">
                  <input type="checkbox" name="hit[]" value="1" id="hit_id" <?= (isset($_GET['hit']) and $_GET['hit']['0'] == 1) ? 'checked' : '' ?>>
                  <label for="hit_id" class="fbc-label"><span class="before"></span>Хит продаж</label>
                  <input type="checkbox" name="new[]" value="1" id="new_id" <?= (isset($_GET['new']) and $_GET['new']['0'] == 1) ? 'checked' : '' ?>>
                  <label for="new_id" class="fbc-label"><span class="before"></span>Новое поступление</label>
                  <?php if ($category->getCountSpecial() > 0) : ?>
                    <input type="checkbox" name="spec[]" value="1" id="spec_id" <?= (isset($_GET['spec']) and $_GET['spec']['0'] == 1) ? 'checked' : '' ?>>
                    <label for="spec_id" class="fbc-label"><span class="before"></span>Акции и скидки</label>
                  <?php endif ?>

                  <div class="selected-filters"></div>
                </div>
              </div>

            </form>
          </div>
        </div>
    </div>

    <?php if ($dataProvider->itemCount > 0) : ?>
      <div class="container">
        <?php
        $this->widget(
          'application.components.MyListView',
          [
            'dataProvider' => $dataProvider,
            'id' => 'product-box',
            'itemView' => '//store/product/' . $this->storeItem,
            'emptyText' => 'В данной категории нет товаров.',
            'summaryText' => "{count} тов.",
            'template' =>
            '{controls}
                                            {items}
                                            <div class="product-nav">
                                                {pager}
                                                {countValue}

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
            'ajaxUpdate' => true,
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
    <?php else : ?>
      <div class="container">
        В данной категории пока нет товаров
      </div>
    <?php endif ?>
    <?php if (!empty($category->short_description)) : ?>
      <div class="container">
        <div class="cd-box">
          <?= $category->short_description ?>
        </div>
      </div>
    <?php endif ?>
    </section>
  </div><!--/catalog-content__content-->

</div>
</div>
<div class="page-content category-content" id="category-deteals">
  <div class="container cat-desc-container">
    <?php if (!empty($category->description)) : ?>
      <?= $category->description ?>
    <?php endif ?>
    <?php if (!empty($category->linked_id)) : ?>
      <?php $prod = Product::model()->findByPk($category->linked_id) ?>
      <div class="ctc__descr">
        <?php if (empty($category->description)) : ?>
          <div class="ctc__desc-text">
            <?= $prod['description'] ?>
          </div>
        <?php endif ?>
      </div>
      <?php if ((int)$category->parent_id != 15) : ?>
        <?php if (!empty($prod['data'])) : ?>
          <h2 class="page-title">
            Варианты укладки
          </h2>
          <div class="shemes-photos">
            <?= $prod['data'] ?>
          </div>
        <?php endif ?>
      <?php else : ?>
        <?php if ((int)$category->id != 84 and (int)$category->id != 76) : ?>
          <h2 class="page-title">
            Визуализация кладки

          </h2>

          <div class="container keramika-objects">
            <?php $this->widget('application.modules.gallery.widgets.GalleryNewWidget', [
              'view' => 'product-objects',
              'name' => $prod['name'],
            ]); ?>
          </div>
        <?php else : ?>
          <?php if ((int)$category->id != 76) : ?>
            <h2 class="page-title">
              Варианты стен из керамического блока BRAER
            </h2>
            <div class="shemes-photos kirpichiye-blocki">
              <?= $prod['data'] ?>
            </div>

          <?php endif ?>
        <?php endif ?>
      <?php endif ?>
      <?php
      Yii::import('application.modules.gallery.models.*');
      $gal = Gallery::model()->findByAttributes(['name' => $prod['name']]); ?>
      <?php if (!empty($gal)) : ?>
        <?php if ((int)$category->id != 84) : ?>
          <h2 class="page-title">Фото объектов</h2>
          <div class="container container-product-objects<?= (int)$category->parent_id == 15 ? ' keramik-gallery' : '' ?>">
            <?php $this->widget('application.modules.gallery.widgets.GalleryNewWidget', [
              'view' => 'product-objects',
              'name' => $prod['name'],
            ]); ?>
          </div>
        <?php endif ?>
      <?php endif ?>
    <?php endif ?>
    <?php if ((int)$category->id == 15) : ?>
      <div class="container container-kp">
        <?php $this->widget('application.modules.gallery.widgets.GalleryNewWidget', [
          'view' => 'product-objects',
          'name' => $category->name,
        ]); ?>
      </div>
    <?php endif ?>
  </div>
</div>
<div class="page-content category-content" id="category-sertificates">
  <div class="container cat-desc-container">
    <?php if (!empty($category->sertificate)) : ?>
      <?= $category->sertificate ?>
    <?php else : ?>
      На стадии наполнения
    <?php endif ?>
  </div>
</div>