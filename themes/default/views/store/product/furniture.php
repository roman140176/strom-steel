<?php

/* @var $product Product */

$this->title = $product->getMetaTitle();
$this->description = $product->getMetaDescription();
$this->keywords = $product->getMetaKeywords();
$this->canonical = $product->getMetaCanonical();
Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/swup.min.js');
Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slick.min.js');
Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/fancy.js', CClientScript::POS_END);
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
        <div class="product-view__raiting">
          <div class="raiting-list">
            <div class="raiting-list__list ">
              <div class="raiting-list">
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                  <div class="raiting-list__item <?= ($i <= $product->raiting) ? 'active' : ''; ?>"></div>
                <?php endfor; ?>
              </div>
            </div>
            <div class="raiting-list__text">
              <?php
              $reviewsCount = "<span style='display:none'>$product->reviewsCount</span>";
              ?>
              <?=
              $product->num_decline($reviewsCount, 'отзыв', 'отзыва', 'отзывов');
              ?>
              <span><?= $product->reviewsCount ?></span>
            </div>
          </div>
          <div class="product-view__but">
            <a class="product-view__link js-button" href="#" data-toggle="modal" data-target="#reviewZayavkaModal">Оставить отзыв</a>
          </div>
        </div>
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

          <?php if (count($product->getSiblingProducts()) > 0) : ?>
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
          <div class="products-item_inp">
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
                    <span></span>
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
          <div class="product-view__bot<?= empty($product->getVariantsGroup()) ? ' m-zero' : '' ?>">

            <div class="price-construct" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
              <input type="hidden" id="base-price" value="<?= round($product->getResultPrice(), 2); ?>" />
              <div class="price-construct__sum furniture-price">
                <div>
                  <div class="sum__label graycolor">Цена комплекта:</div>
                  <div class="sum__price" id="complect-price">
                    <span><?= round($product->getResultPrice(), 2); ?></span><?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?>
                  </div>
                </div>
                <?php if ($product->hasDiscount()) : ?>
                  <span class="product-price__old on-view-furniture">
                    <div class="discount_box">
                      <?= round($product->getPercent()) ?>%
                    </div>
                    <span class="price-old">
                      <?= str_replace('.00', '', number_format($product->getBasePrice(), 2, '.', ' ')); ?><?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble-old.svg'); ?>
                    </span>

                  </span>
                <?php endif; ?>
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
                <?php $positions = Yii::app()->cart->getPositions() ?>
                <?php if (isset($positions['product_' . $product->id . '_'])) : ?>
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
      <div class="product-view__img pv__furniture">

        <div class="image-preview" id="image-preview">


          <div class="image-preview__img impt__furniture">
            <a data-fancybox="image" data-src="<?= StoreImage::product($product); ?>" href="" class="fancy-Image">

              <span class="<?= !$product->category['is_card_big'] ? 'fancy-img-box' : 'fancy-img-bigbox' ?>">
                <img class="gallery-image" src="<?= !$product->category['is_card_big'] ? $product->getImageUrl(268, 501, true) : $product->getImageUrl(488, 501, true) ?>" itemprop="image" />
              </span>
            </a>
          </div>


          <?php foreach ($images as $key => $image) : ?>

            <div class="image-preview__img impt__furniture">
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
          <div class="image-thumbnail imf" id="image-thumbnail">
            <div class="image-thumbnail__box">
              <div class="image-thumbnail__img imt__furniture">
                <img src="<?= $product->getImageUrl(0, 0, true) ?>" alt="">
              </div>
            </div>

            <?php foreach ($images as $key => $image) : ?>

              <div class="image-thumbnail__box">
                <div class="image-thumbnail__img imt__furniture">
                  <img src="<?= $image->getImageUrl(0, 0, true) ?>" alt="">
                </div>
              </div>

            <?php endforeach ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="container ap-container">
      <?php $this->renderPartial('./_advents'); ?>
    </div>
    <div class="container tabs-container mt70">
      <ul class="nav nav-tabs nav-product-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#full_desc" aria-controls="full_desc" role="tab" data-toggle="tab">Полное описание</a></li>
        <li role="presentation"><a href="#services_p" aria-controls="services_p" role="tab" data-toggle="tab">Услуги и сервисы</a></li>
        <li role="presentation"><a href="#reviews_p" aria-controls="reviews_p" role="tab" data-toggle="tab">Отзывы</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="full_desc"></div>
        <div class="tab-pane" id="services_p"></div>
        <div class="tab-pane" id="reviews_p"></div>
      </div>
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

    const options = {
    cache: false,
    elements: ['#swup'],
    FORM_SELECTOR: 'form[data-swup-form]',
      linkSelector:
      'a[href^=\"' +
      window.location.origin +
      '\"]:not([data-no-swup]), a[href^=\"/\"]:not([data-no-swup]), a[href^=\"#\"]:not([data-no-swup])'

};

        const swup = new Swup(options);

swup.on('contentReplaced', function () {
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
      $('.products-inp_row-wrap').each(function(){
    var block = $(this).find('.products-inp_row'),
        input = block.find('.products-inp_col').find('input[data-amount=\"0\"]'),
        label = input.next(),
        text = label.text();
        block.find('.products-inp_col').find('input').prop('checked',false);
        $(this).find('span').append(text);
$(this).on('click',function(e){
    var childBox = $(this).find('.products-inp_row');
    childBox.toggleClass('opened');
    if(childBox.hasClass('opened')){
        $(this).find('span').text('');
        }else{
            $(this).find('span').append(text);
        }
    })

    });

        var priceElement = $('#complect-price span');
        var basePrice = parseFloat($('#base-price').val());
        $('.products-inp_row').find('input[type=\"radio\"]').change(function () {
            $(this).parents('.products-inp_row').removeClass('opened');
            var text = $(this).next().text();
            $(this).parents('.products-inp_row-wrap').find('span').text(text);
                        var _basePrice = basePrice;
            var variants = [];
            var varElements = $('.products-inp_row').find('input[type=\"radio\"]');

            var hasBasePriceVariant = false;

            var newPrice = _basePrice;
            $.each(varElements, function (index, elem) {
                var varId = elem.value;

                if (varId) {
                    var option = $('.products-inp_col').find('input[value=\"' + varId + '\"]:checked');
                    var variant = {amount: option.data('amount'), type: option.data('type')};
                    variants.push(variant);
                    switch (variant.type) {
                        case 0: // sum
                        newPrice += variant.amount;
                        break;
                        case 1: // percent
                        newPrice += _basePrice * ( variant.amount / 100);
                        break;
                        case 2:
                        newPrice = thousandSeparator(variant.amount);
                        break;
                    }
                }
            });

            priceElement.html(newPrice);
            $('.sharp').html(newPrice);
        });
        $('.inp-complect').find('input').on('change',function(i,e){
                var _basePrice = parseFloat(priceElement.html());
                var varElements = $('.inp-complect').find('input');
                var input = $('#product-quantity-input');
                var value = parseFloat($('#product-quantity-input').val());
                var sharp = $('.sharp');
                var newPrice = _basePrice;
                var sharpPrice;
                  if($(this).context.checked){
                    newPrice+=parseFloat($(this).val());
                    sharpPrice = newPrice*value;

                  }else{
                    newPrice-=parseFloat($(this).val());
                    sharpPrice = newPrice*value;
                  }
                  priceElement.html(newPrice);
                  sharp.html(sharpPrice);
            });
      });

    ");
?>

<?php $this->widget('application.modules.review.widgets.ReviewWidget', [
  'product_id' => $product->id,
  'view' => 'reviewmodalwidget'
]); ?>