<?php

/* @var $product Product */

$this->title = $product->getMetaTitle();
$this->description = $product->getMetaDescription();
$this->keywords = $product->getMetaKeywords();
$this->canonical = $product->getMetaCanonical();
$mainAssets = Yii::app()->getModule('store')->getAssetsUrl();


$this->breadcrumbs = array_merge(
  [Yii::t("StoreModule.store", 'Catalog') => ['/store/category/index']],
  $product->category ? $product->category->getBreadcrumbs(true) : [],
  [CHtml::encode($product->name)]
);
?>
<?php $positions = Yii::app()->cart->getPositions() ?>
<div class="page-content product-view-content" xmlns="http://www.w3.org/1999/html" itemscope itemtype="http://schema.org/Product" id="swup">
  <div class="container">
    <?php $this->widget('application.components.MyTbBreadcrumbs', [
      'links' => $this->breadcrumbs,
    ]); ?>


    <div class="product-views">
      <div class="product-view__info">
        <h1 class="title" itemprop="name"><?= CHtml::encode($product->getTitle()); ?></h1>
        <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$product->quantity ?>' class="preview-box-form" data-swup-form>
          <div class="instoc-view__value">
            <span class="instoc-view__name">Наличие:</span>
            <?php if ($product->in_stock == 1) : ?>
              Товар в наличии
            <?php else : ?>
              Под заказ
            <?php endif ?>
          </div>

          <?php if (count($product->getSiblingProducts()) > 1) : ?>
            <div class="attr-name"><span>цвет:</span><label><?= $product->icon_out; ?></label></div>
            <?php $this->widget('application.modules.store.widgets.SiblingProductsWidget', [
              'model_product' => $product->model_product
            ]); ?>

          <?php endif ?>
          <input type="hidden" name="Product[id]" value="<?= $product->id; ?>" />
          <?= CHtml::hiddenField(
            Yii::app()->getRequest()->csrfTokenName,
            Yii::app()->getRequest()->csrfToken
          ); ?>
          <?php $varIds = []; ?>
          <?php foreach ($positions as $key => $pos) : ?>
            <?php foreach ($pos->selectedVariants as $k => $var) : ?>
              <?php
              array_push($varIds, $var->id)
              ?>
            <?php endforeach ?>
          <?php endforeach ?>
          <?php
          $varId = implode('_', $varIds);
          ?>
          <div class="products-item_inp<?= (isset($positions['product_' . $product->id . '_']) || isset($positions['product_' . $product->id . '_' . $varId])) ? ' disabled' : '' ?>">
            <?php
            $id = 0;
            ?>

            <?php $arr = $product->getVariantsGroupName(); ?>
            <?php foreach ($product->getVariantsGroup() as $title => $variantsGroup) : { ?>
                <?php $id++; ?>
                <div class="variant-names">
                  <div class="variant-name">
                    <?php
                    $curr = current($arr);
                    echo "<span>$curr</span>";
                    next($arr);
                    ?>
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/i.svg'); ?>
                  </div>
                  <div class="products-inp_row-wrap">
                    <span class="pirw"></span>
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/gal.svg'); ?>
                    <div class="products-inp_row id-<?= $product->id ?>">
                      <?php
                      $listData = CHtml::listData($variantsGroup, 'id', 'optionValue');
                      echo MyHtml::radioButtonList(
                        "ProductVariant[]-{$id}-{$product->id}",
                        current(array_keys($listData)),
                        $listData,
                        [
                          'itemOptions' => $product->getVariantsOptions(),
                          'container' => '',
                          'separator' => '',
                          'template' => "
                                                                <div class=\"products-inp_col idcol-{$product->id}\">
                                                                    {input}
                                                                    {label}
                                                                </div>
                                                            "
                        ]
                      ); ?>
                    </div>
                  </div>
                </div>
            <?php }
            endforeach; ?>
          </div>
          <div class="product-view__bot">
            <?php //Цена 
            ?>
            <div class="product-view__price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
              <input type="hidden" id="base-price" value="<?= round($product->getResultPrice(), 2); ?>" />
              <div class="canvas-price">
                <div class="product-view__header">Цена полотна:</div>
                <div class="product-prices <?= ($product->hasDiscount()) ? 'product-price-new' : '' ?>">

                  <?php if ($product->hasDiscount()) : ?>
                    <span class="product-price__old on-view-page">
                      <div class="discount_box">
                        <?= round($product->getPercent()) ?>%
                      </div>
                      <span class="price-old">
                        <?= str_replace('.00', '', number_format($product->getBasePrice(), 2, '.', ' ')); ?><?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble-old.svg'); ?>
                      </span>

                    </span>
                  <?php endif; ?>

                  <span class="price-results">
                    <?php //= round($product->getResultPrice(), 2); 
                    ?>
                    <span id="result-price"><?= str_replace('.00', '', number_format($product->getResultPrice(), 2, '.', ' ')); ?></span><?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?>
                  </span>


                  <meta itemprop="priceCurrency" content="<?= Yii::app()->getModule('store')->currency ?>">
                  <?= $product->isInStock() ? '<link itemprop="availability" href="http://schema.org/InStock">' : '<link itemprop="availability" href="http://schema.org/PreOrder">'; ?>
                </div>
              </div>

              <div class="complectation<?= (isset($positions['product_' . $product->id . '_']) || isset($positions['product_' . $product->id . '_' . $varId])) ? ' disabled' : '' ?>">
                <div class="complectation-label">Комплектация</div>
                <?php if ($product->casing != null) : ?>
                  <div class="casing_box inp-complect">
                    <input type="checkbox" name="Product[is_casing]" value="<?= round($product->casing, 2); ?>" id="product_casing">
                    <label for="product_casing">короб<span> +<?= str_replace('.00', '', number_format($product->casing, 2, '.', ' ')); ?></span></label>
                  </div>
                <?php endif ?>
                <?php if ($product->platband != null) : ?>
                  <div class="platband_box inp-complect">
                    <input type="checkbox" name="Product[is_platband]" value="<?= round($product->platband, 2); ?>" id="product_platband">
                    <label for="product_platband">наличник<span> +<?= str_replace('.00', '', number_format($product->platband, 2, '.', ' ')); ?></label>
                  </div>
                <?php endif ?>
              </div>
            </div>
            <div class="price-construct">
              <div class="price-construct__sum">
                <div class="sum__label graycolor">Цена комплекта:</div>
                <div class="sum__price" id="complect-price">
                  <span><?= round($product->getResultPrice(), 2); ?></span><?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?>
                </div>
              </div>

              <div class="product-view__spinput">
                <?php
                $minQuantity = 1;
                $maxQuantity = Yii::app()->getModule('store')->controlStockBalances ? $data->getAvailableQuantity() : 99;
                $productCart = isset($positions["product_" . $product->id . "_"]) ? $positions["product_" . $product->id . "_"] : null;
                $quantity = $productCart ? $productCart->getQuantity() : 1;
                ?>
                <span data-min-value='<?= $minQuantity; ?>' data-max-value='<?= $maxQuantity; ?>' class="spinput js-spinput">
                  <span class="spinput__minus js-spinput__minus product-quantity-decrease">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/minus.svg'); ?>
                  </span>
                  <input name="Product[quantity]" value="<?= $quantity ?>" class="spinput__value product-quantity-input" id="product-quantity-input" />
                  <span class="spinput__plus js-spinput__plus product-quantity-increase">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/plus.svg'); ?>
                  </span>
                </span>
              </div>
              <div class="price-construct__sum-plus">
                <div class="sum__label graycolor">На сумму:</div>
                <span class="js-product-price">
                  <span class="sharp" itemprop="price">
                    <?= round($product->getResultPrice(), 2); ?>
                  </span>
                  <span style="display: none;" itemprop="priceCurrency">RUB</span>
                  <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?>
                </span>

              </div>
            </div>
            <div class="product-box__futer d-flex">
              <?php if (Yii::app()->hasModule('cart')) : ?>
                <?php if (isset($positions['product_' . $product->id . '_']) || isset($positions['product_' . $product->id . '_' . $varId])) : ?>
                  <button class="but-add-cart but-product added" id="add-product-to-cart-<?= $product->id ?>" disabled="true">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/checked.svg'); ?>
                    <span>В корзине</span>
                  </button>
                <?php else : ?>
                  <button class="but-add-cart js-cart-view but-product" id="add-product-to-cart-<?= $product->id ?>">
                    <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/cart-white.svg') ?>
                    <span>Купить</span>
                  </button>
                <?php endif; ?>
              <?php endif; ?>
              <a href="#" class="but-product select-acsessuars">
                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/access.svg'); ?>
                <span>Подобрать &nbsp;</span> аксессуары
              </a>
              <div class="favorite-and-offer d-flex">
                <?php $this->widget('application.modules.store.widgets.OffersWidget', ['id' => $product->id]) ?>
                <div class="favorits favorits-on-single">
                  <?php if (Yii::app()->hasModule('favorite')) : ?>

                    <a class="toolbar-button" href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>" data-no-swup>

                      <div class="product-button__item product-favorite">
                        <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                          'product' => $product,
                          'view' => "favorite-item"
                        ]); ?>
                      </div>
                    </a>


                  <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="product-view__hidden hidden">
              <span id="product-result-price"><?= round($product->getResultPrice(), 2); ?></span> x
              <span id="product-quantity">1</span> =
              <span id="product-total-price"><?= round($product->getResultPrice(), 2); ?></span>
              <span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
            </div>
          </div>
        </form>
        <div id="share">
          <div class="social" data-url="<?php echo !empty($_SERVER['HTTPS']) ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-title="">
            <a class="push facebook" data-id="fb"></a>
            <a class="push vkontakte" data-id="vk"></a>
            <a class="push ok" data-id="ok"></i></a>
            <a class="push twitter" data-id="tw"></i></a>
            <a class="push viber" data-id="viber"></i></a>
            <a class="push what" data-id="what"></i></a>
          </div>
          <div class="like">Поделитесь ссылкой с друзьями</div>
        </div>
        <?php $this->renderPartial('./_advents'); ?>
      </div>
      <?php $images = $product->getImages(); ?>
      <div class="product-view__img">

        <div class="image-preview" id="image-preview">


          <div class="image-preview__img">
            <a data-fancybox="image" data-src="<?= StoreImage::product($product); ?>" href="" class="fancy-Image">

              <span class="<?= !$product->category['is_card_big'] ? 'fancy-img-box' : 'fancy-img-bigbox' ?>">
                <img class="gallery-image" src="<?= !$product->category['is_card_big'] ? $product->getImageUrl(268, 501, true) : $product->getImageUrl(488, 501, true) ?>" itemprop="image" />
              </span>
            </a>
          </div>


          <?php foreach ($images as $key => $image) : ?>

            <div class="image-preview__img">
              <a data-fancybox="<?= $key ?>" data-src="<?= $image->getImageUrl(); ?>" href="" class="fancy-Image">
                <span class="<?= !$product->category['is_card_big'] ? 'fancy-img-box' : 'fancy-img-bigbox' ?>">
                  <img src="<?= !$product->category['is_card_big'] ? $image->getImageUrl(268, 501, true) : $image->getImageUrl(488, 501, true) ?>" alt="">
                </span>
              </a>
            </div>

          <?php endforeach ?>
        </div>

        <!-- Миниатюры -->
        <?php if (count($images) > 0) : ?>
          <div class="image-thumbnail" id="image-thumbnail">
            <div class="image-thumbnail__box">
              <div class="image-thumbnail__img">
                <img src="<?= $product->getImageUrl(0, 0, true) ?>" alt="">
              </div>
            </div>

            <?php foreach ($images as $key => $image) : ?>

              <div class="image-thumbnail__box">
                <div class="image-thumbnail__img">
                  <img src="<?= $image->getImageUrl(0, 0, true) ?>" alt="">
                </div>
              </div>

            <?php endforeach ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="container ap-container">
    <?php $this->renderPartial('./_advents'); ?>
  </div>
  <div class="container tabs-container">
    <ul class="nav nav-tabs nav-product-tabs" role="tablist">
      <li role="presentation"><a href="#full_desc" aria-controls="full_desc" role="tab" data-toggle="tab">Полное описание</a></li>
      <li role="presentation" class="active" id="selection_acc"><a href="#acsessuars_p" aria-controls="acsessuars_p" role="tab" data-toggle="tab">Подбор аксессуаров</a></li>
      <li role="presentation"><a href="#services_p" aria-controls="services_p" role="tab" data-toggle="tab">Услуги и сервисы</a></li>
      <li role="presentation"><a href="#reviews_p" aria-controls="reviews_p" role="tab" data-toggle="tab">Отзывы</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane" id="full_desc">
        <div class="full-desc">
          <?= $product->description ?>
        </div>
      </div>
      <div class="tab-pane active" id="acsessuars_p">
        <h2 class="accordion-title">Аксессуары для <?= $product->name ?></h2>
        <?php $this->widget('application.modules.store.widgets.CatalogListWidget', [
          'view' => 'category-accordion',
          'linked_id' => $product->category['parent_id']
        ]); ?>
        <div class="category-list__result">
          <div class="and-result-text">
            Итого:
          </div>
          <div class="result-qwuntity" id="rq">
            <span>Аксессуаров</span>
            <div class="acc_label">
              <div id="rq_res">1</div> шт.
            </div>
          </div>
          <div class="result-qwuntity" id="rsm">
            <span>На сумму:</span>
            <div class="acc_label">
              <div id="rsm_sum">0</div>
              <span><?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?></span>
            </div>
          </div>
          <a href="#" class="but-product result-to-cart">
            <?= CHtml::image($this->mainAssets . '/images/svg/cart-white.svg') ?>
            <span>Добавить к заказу</span>
          </a>
        </div>
      </div>
      <div class="tab-pane" id="services_p"></div>
      <div class="tab-pane" id="reviews_p"></div>
    </div>
  </div>
</div>

<?php
Yii::app()->clientScript->registerScript("viewOnSwup", "
          function slicks(){
        $('.image-preview').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: false,
        arrows: true,
        asNavFor: '.image-thumbnail',
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                }
            }
        ]
    });
    $('.image-thumbnail').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            infinity:false,
            dots: false,
            arrows: false,
            asNavFor: '.image-preview',
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1001,
                    settings: {
                        vertical: false,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
}
$(document).delegate('.raiting-list-form .raiting-list-form__item', 'click', function(){
        var Data = $(this);
        var id = Data.data('id');
        $('.raiting-list-form .raiting-list-form__item').removeClass('active');
        Data.addClass('active').prevAll('.raiting-list-form__item').addClass('active');
        Data.parent().addClass('no-hover');
        $('#Review_rating').val(id);
        return false;
        });

slicks();
    $('.social a').on('click', function() {
        var id = $(this).data('id');
        if (id) {
            var data = $(this).parent('.social');
            var url = data.data('url') || location.href,
                title = data.data('title') || '',
                desc = data.data('desc') || '';
            Shares.share(id, url, title, desc);
        }
    });

    ");
?>
<?php $this->widget('application.modules.review.widgets.ReviewWidget', [
  'product_id' => $product->id,
  'view' => 'reviewmodalwidget'
]); ?>