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
  [$product->name]
);

$host = Yii::app()->request->hostInfo;
$productUrl = $host . Yii::app()->request->requestUri;
$productImage = StoreImage::product($product);
if ($productImage && !preg_match('~^https?://~', $productImage)) {
  $productImage = $host . $productImage;
}

$productSchema = [
  '@context'    => 'https://schema.org',
  '@type'       => 'Product',
  'name'        => $product->getTitle(),
  'url'         => $productUrl,
];
$productDescription = trim(strip_tags((string)($product->description ?: $product->short_description)));
if ($productDescription !== '') {
  $productSchema['description'] = mb_substr($productDescription, 0, 5000);
}
if ($productImage) {
  $productSchema['image'] = $productImage;
}
if (!empty($product->sku)) {
  $productSchema['sku'] = (string)$product->sku;
}
if (!empty($product->producer) && !empty($product->producer->name)) {
  $productSchema['brand'] = [
    '@type' => 'Brand',
    'name'  => $product->producer->name,
  ];
}
if ($product->getResultPrice() > 0) {
  $productSchema['offers'] = [
    '@type'         => 'Offer',
    'url'           => $productUrl,
    'priceCurrency' => 'RUB',
    'price'         => (float)$product->getResultPrice(),
    'availability'  => ((int)$product->in_stock === Product::STATUS_IN_STOCK)
      ? 'https://schema.org/InStock'
      : 'https://schema.org/OutOfStock',
    'seller'        => [
      '@type' => 'Organization',
      'name'  => 'СТРОМ ТРЕЙД',
    ],
  ];
}

$breadcrumbItems = [[
  '@type'    => 'ListItem',
  'position' => 1,
  'name'     => 'Главная',
  'item'     => $host . '/',
]];
$bcPos = 2;
foreach ($this->breadcrumbs as $bcLabel => $bcUrl) {
  if (is_string($bcLabel) && (is_array($bcUrl) || is_string($bcUrl))) {
    $bcItemUrl = is_array($bcUrl) ? $host . Yii::app()->createUrl($bcUrl[0]) : $bcUrl;
    $breadcrumbItems[] = [
      '@type'    => 'ListItem',
      'position' => $bcPos++,
      'name'     => $bcLabel,
      'item'     => $bcItemUrl,
    ];
  } else {
    $breadcrumbItems[] = [
      '@type'    => 'ListItem',
      'position' => $bcPos++,
      'name'     => is_string($bcLabel) ? $bcLabel : $bcUrl,
    ];
  }
}
$breadcrumbSchema = [
  '@context'        => 'https://schema.org',
  '@type'           => 'BreadcrumbList',
  'itemListElement' => $breadcrumbItems,
];
?>
<script type="application/ld+json">
<?= json_encode($productSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>
<script type="application/ld+json">
<?= json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>
<div class="page-content product-single-view" xmlns="http://www.w3.org/1999/html" itemscope itemtype="http://schema.org/Product">
  <div class="container">
    <?php $this->widget('application.components.MyTbBreadcrumbs', [
      'links' => $this->breadcrumbs,
    ]); ?>
    <div class="product-views-wrap">
      <h1 class="product-single-title" itemprop="name"><?= CHtml::encode($product->getTitle()); ?></h1>
      <div class="product-views d-flex js-product-item<?= ($product->getIsProductCart() > 0) ? ' item-added' : '' ?>" id="<?= $product->getId() ?>">
        <div class="product-views__img">
          <?php $images = $product->getImages(); ?>
          <div class="image-preview" id="image-preview">
            <div class="image-preview__img">
              <a data-fancybox="image" data-src="<?= StoreImage::product($product); ?>" href="" class="fancy-Image">
                <img class="gallery-image" src="<?= !$product->category['is_card_big'] ? $product->getImageUrl(444, 320, true) : $product->getImageUrl(488, 501, true) ?>" itemprop="image" />

              </a>
            </div>
            <?php foreach ($images as $key => $image) : ?>
              <div class="image-preview__img">
                <a data-fancybox="<?= $key ?>" data-src="<?= $image->getImageUrl(); ?>" href="" class="fancy-Image">
                  <img src="<?= !$product->category['is_card_big'] ? $image->getImageUrl(444, 320, true) : $image->getImageUrl(488, 501, true) ?>" alt="">
                </a>
              </div>
            <?php endforeach ?>
          </div>
          <?php if (count($images) > 0) : ?>
            <div class="image-thumbnails" id="image-thumbnail">
              <div class="it__box">
                <div class="it__img">
                  <img src="<?= $product->getImageUrl(134, 90, true) ?>" alt="">
                </div>
              </div>
              <?php foreach ($images as $key => $image) : ?>
                <div class="it__box">
                  <div class="it__img">
                    <img src="<?= $image->getImageUrl(134, 90, true) ?>" alt="">
                  </div>
                </div>
              <?php endforeach ?>
            </div>
          <?php endif; ?>
        </div><!--/product-views__img-->
        <div class="product-views__info">
          <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$product->quantity ?>'>
            <input type="hidden" name="Product[id]" value="<?= $product->id; ?>" />
            <?= CHtml::hiddenField(
              Yii::app()->getRequest()->csrfTokenName,
              Yii::app()->getRequest()->csrfToken
            ); ?>
            <?php if ($product->getResultPrice() > 0) : ?>
              <div class="product-single-price-box d-flex" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <div class="psb__price-box">

                  <div class="price-base__title">Цена:</div>
                  <div class="psb__price-base">
                    <div class="psb__price-result" id="result-price<?= $product->id ?>">
                      <span class="pb-main">
                        <?= str_replace('.00', '', number_format($product->getResultPrice(), 2, '.', ' ')); ?>
                      </span>
                      <span style="display: none;" itemprop="price"><?= $product->getResultPrice(); ?></span>
                      <span style="display: none;" itemprop="priceCurrency">RUB</span>
                      <span class="pb-curr">
                        <i class="fa fa-rub" aria-hidden="true"></i>
                        <?php if (!empty($product->category['units'])) : ?>
                          /
                        <?php endif ?>
                      </span>
                      <span class="pb-m">
                        <?php if (!empty($product->category['units'])) : ?>
                          <?= $product->category['units'] ?>
                        <?php endif ?>
                      </span>

                    </div>
                  </div>
                </div>
                <?php if ($product->hasDiscount()) : ?>
                  <div class="psb__old">
                    <div class="psb__discount_box">
                      - <?= round($product->getPercent()) ?>%
                    </div>
                    <div class="psb__price-old">
                      <span class="po-main"> <?= str_replace('.00', '', number_format($product->getBasePrice(), 2, '.', ' ')); ?></span><span class="po-curr"><i class="fa fa-rub" aria-hidden="true"></i>
                        <?php if (!empty($product->category['units'])) : ?>
                          /
                        <?php endif ?>
                      </span>
                      <span class="po-m">
                        <?php if (!empty($product->category['units'])) : ?>
                          <?= $product->category['units'] ?>
                        <?php endif ?>
                      </span>
                    </div>

                  </div>

                <?php endif; ?>
              </div><!--/product-single-price-box-->
              <div class="variants">
                <?php if (count($product->getVariantsGroup()) > 0) : ?>
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

                          </div>
                          <div class="products-inp_row-wrap">
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
                <?php endif ?>
              </div>

              <div class="spinputs-flex d-flex" style="display:none!important">

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
                </span><!--/spinput-->
                <div class="spinput_result">
                  <div class="spinput_result-title">На сумму:</div>
                  <div class="spinput_result-sum-box">
                    <span class="spinput_result-sum"><?= str_replace('.00', '', $product->getResultPrice()); ?></span>
                    <input type="hidden" value="<?= str_replace('.00', '', $product->getResultPrice()); ?>" class="hidden-price">
                    <span class="spinput_result-currency"><i class="fa fa-rub" aria-hidden="true"></i></span>
                  </div>
                </div><!--/spinput_result-->

              </div><!--/spinputs-flex-->
            <?php endif; ?>
            <div class="product-box-footer d-flex">
              <?php if ($product->getResultPrice() > 0) : ?>
                <a href="<?= ($product->getIsProductCart()) ? Yii::app()->createUrl('cart/cart/index') : '#'; ?>" class="but-product-single <?= ($product->getIsProductCart() < 1) ? ' js-but-add-cart ' : ' ' ?>but-product<?= ($product->getIsProductCart() > 0) ? ' added' : '' ?>" id="add-product-to-cart-<?= $product->id ?>" data-product-id="<?= $product->id; ?>" data-cart-add-url="<?= Yii::app()->createUrl('/cart/cart/add'); ?>">
                  <?= CHtml::image($this->mainAssets . '/images/svg/cart.svg') ?>
                  <?php if ($product->getIsProductCart() < 1) : ?>
                    <span>Купить</span>
                  <?php else : ?>
                    <span>В корзине</span>
                  <?php endif ?>

                </a>
                <a class="toolbar-button single-favorite">
                  <div class="product-button__item product-favorite">
                    <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                      'product' => $product,
                      'view' => "favorite-single"
                    ]); ?>
                    <span>В избранное</span>
                  </div>
                </a>
              <?php else : ?>
                <div class="to-order">
                  Под заказ
                </div>
              <?php endif; ?>
              <a href="#" class="ask-question js-button" data-target="#CallbackProduct" data-toggle="modal">
                Задать вопрос по товару
              </a>

            </div>
            <div class="product-view__hidden hidden">
              <span id="product-result-price"><?= round($product->getResultPrice(), 2); ?></span> x
              <span id="product-quantity">1</span> =
              <span id="product-total-price"><?= round($product->getResultPrice(), 2); ?></span>
              <span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
            </div>
            <div class="properties-title">Характеристики:</div>
            <div class="all-properties">
              <?php foreach ($product->getAttributeGroups() as $groupName => $items) : ?>
                <?php foreach ($items as $attribute) : ?>
                  <?php if (AttributeRender::renderValue($attribute, $product->attribute($attribute)) != null) : ?>

                    <div class="all-props__wrap d-flex">
                      <div class="key">
                        <span><?= CHtml::encode($attribute->title); ?>:</span>
                      </div>

                      <div class="value">
                        <?= AttributeRender::renderValue($attribute, $product->attribute($attribute)); ?>
                      </div>
                    </div>
                  <?php endif ?>

                <?php endforeach ?>
              <?php endforeach ?>
            </div>


            <div class="more-params">Смотреть все параметры</div>
          </form>
        </div><!--/product-views__info-->
      </div><!--/product-views-->
      <div class="category-tabs-nav d-flex">
        <div class="ctn__link active" data-content="#charapter">Описание и характеристики</div>
        <?php
                  if(!empty($product->short_description)):
        ?>
        <div class="ctn__link" data-content="#docs">Документы и сертификаты</div>
        <?php
        endif;
        ?>
        <?php $is_tab = false; ?>
        <?php if ((int)$product->category['parent_id'] == 15 and (int)$product->category['id'] != 84) : ?>
          <?php $is_tab = true; ?>
        <?php endif ?>
        <?php if ($product->category['is_home']) : ?>
          <?php if (!$is_tab) : ?>
            <div class="ctn__link" data-content="#schemes">
              <?php if ((int)$product->category['id'] == 84) : ?>
                Варианты стен из керамического блока BRAER
              <?php else : ?>
                Варианты укладки
              <?php endif ?>
            </div>
          <?php endif ?>
          <div class="ctn__link" data-content="#photos-obj">
            <?php if ((int)$product->category['id'] != 84) : ?>
              Фото объектов
            <?php else : ?>
              Укладка керамических блоков
            <?php endif ?>
          </div>
        <?php endif ?>
      </div>
      <div class="category-tabs-contents">
        <div id="charapter" class="t_content active">
          <div class="ctc__flex d-flex">
            <div class="ctc__attributes">
              <div class="properties-title big">Характеристики:</div>
              <div class="all-properties">
                <?php foreach ($product->getAttributeGroups() as $groupName => $items) : ?>
                  <?php foreach ($items as $attribute) : ?>
                    <?php if (!empty(AttributeRender::renderValue($attribute, $product->attribute($attribute)))) : ?>
                      <div class="all-props__wrap d-flex">
                        <div class="key">
                          <span><?= CHtml::encode($attribute->title); ?>:</span>
                        </div>

                        <div class="value">
                          <?= AttributeRender::renderValue($attribute, $product->attribute($attribute)); ?>
                        </div>
                      </div>
                    <?php endif ?>

                  <?php endforeach ?>
                <?php endforeach ?>
                <?php if (!empty($product->weight)) : ?>
                  <div class="all-props__wrap d-flex">
                    <div class="key">Вес, кг</div>
                    <div class="value"><?= $product->weight ?></div>
                  </div>
                <?php endif ?>
                <?php if ($product->category['id'] == 31) : ?>
                  <?php $this->renderPartial('_advents'); ?>
                <?php endif ?>
                <?php if ($product->category['id'] == 32) : ?>
                  <?php $this->renderPartial('_chanel'); ?>
                <?php endif ?>
                <?php if ($product->category['id'] == 33) : ?>
                  <?php $this->renderPartial('_revision'); ?>
                <?php endif ?>

              </div>
              <?php if (!empty($product->short_description)) : ?>
                <div class="features">
                  <div class="features__title">Особенности:</div>
                  <div class="features__text">
                    <?= $product->short_description ?>
                  </div>
                </div>
              <?php endif ?>
              <div class="down-link hidden">
                <span>Показать все характеристики</span>
                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/down-arrow2.svg'); ?>
              </div>
            </div>
            <div class="ctc__desc">
              <?php if (!empty($product->description) || (int)$product->category->id == 52) : ?>
                <div class="properties-title big">Описание</div>
              <?php endif ?>
              <div class="ctc__desc-text">
                <?php if (!empty($product->description)) : ?>
                  <?= $product->description ?>
                <?php else : ?>
                  <?php if ((int)$product->category->id == 52) : ?>
                    <p><strong>Рекомендации по заказу сварного настила Р.</strong></p>
                    <p>Выбор типа настила осуществляется на основании требований Заказчика к конструкции с учётом эксплуатационных характеристик настилов.</p>
                    <p>При выборе геометрических размеров необходимо учитывать максимальные размеры настила: 6100х1000 мм, где 6100 мм — максимальный размер несущей полосы, а 1000 мм — максимальный размер связующего прутка. Связующий пруток фиксирует положение несущих полос и нагрузку не несет.</p>
                    <p><strong>Оптимальный максимальный размер решетки для производства 1500х1000мм.</strong></p>
                  <?php else : ?>
                    <?= '' ?>
                  <?php endif ?>
                <?php endif ?>
              </div>
            </div>
          </div>
          <?php if (!empty($product->txt)) : ?>
            <?= $product->txt ?>
          <?php endif ?>
          <?php if ((int)$product->category->id == 52) : ?>
            <p><span style="color:red">Внимание! </span>При правильном ориентировании настила несущая полоса располагается перпендикулярно движению и опирается концами на несущие элементы (балки, швеллера и т. д.). При неправильном ориентировании настил не будет нести нагрузки, что может привести к разрушению конструкции.</p>
            <div class="pr-flex d-flex">
              <div class="prf__img">
                <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/store/pr1.jpg') ?>
              </div>
              <div class="prf__img">
                <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/store/pr2.jpg') ?>
              </div>
            </div>
            <h4 style="margin-top:30px;margin-bottom:20px"><strong>Пример заказа сварного настила.</strong></h4>
            <div class="exemple-order d-flex">
              <div class="eo__img">
                <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/store/ppp.jpg') ?>
              </div>
              <div class="eo__txt">
                Закрываем площадь габаритами 1250х3690мм: 1250мм – осевое расстояние между несущими опорами. Значит 1250мм – длина несущей полосы настила. Размер связующего прутка желательно не должен превышать 1000мм. В итоге для покрытия площади 1250х3690мм необходимы следующие настилы: 1250х1000мм – 3шт. 1250х690мм – 1шт. Первый размер – всегда длина несущей полосы. Второй размер – длина покровного прутка.
              </div>
            </div>
          <?php endif ?>
        </div><!--#charapter-->
        <!--#pay-delivery-->
        <div id="docs" class="t_content">
          <div class="container"></div>
        </div><!--#docs-->
        <div id="schemes" class="t_content">
          <div class="container">
            <div class="shemes-photos<?= (int)$product->category['id'] == 84 ? ' kirpichiye-blocki' : '' ?>">
              <?= $product->data ?>
            </div>
          </div>
        </div><!--#schemes-->
        <div id="photos-obj" class="t_content">
          <div class="container container-product-objects">
            <?php $this->widget('application.modules.gallery.widgets.GalleryNewWidget', [
              'view' => 'product-objects',
              'name' => $product->name,
            ]); ?>
          </div>
        </div><!--#schemes-->

      </div>
    </div><!--/product-views-wrap-->
  </div><!-- /container -->
</div>
</div>
<?php Yii::app()->clientScript->registerScript("sigle", "
    $('.image-preview').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: false,
        arrows: true,
        asNavFor: '.image-thumbnails',
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                }
            }
        ]
    });
    $('.image-thumbnails').slick({
            slidesToShow: 3,
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
        $('.product-views__info .all-props__wrap').hide();
        if($('.product-views__info .all-props__wrap').length>4){
        $('.product-views__info .all-props__wrap').slice(0,3).show();
        }else{
            $('.product-views__info .all-props__wrap').show();
        }


        $('.ctn__link').on('click',function(){
            var contentLink = $(this).data('content'),
                contentDiv = $(contentLink);
            $('.ctn__link').removeClass('active');
            $('.t_content').removeClass('active');
                $(this).addClass('active');
                contentDiv.addClass('active');
            });

    $('.more-params').on('click',function(){
        var ofset = $('.category-tabs-contents').offset().top;
        $('.category-tabs-nav').find('.ctn__link:eq(0)').trigger('click');
        $('html,body').animate({
            scrollTop:ofset
            },500)
        })
        if($('.ctc__attributes').find('.all-props__wrap').length>7){
            $('.ctc__attributes').find('.all-props__wrap').hide();
            $('.ctc__attributes').find('.all-props__wrap').slice(0,7).show();
            $('.down-link').removeClass('hidden');
        }
        $('.down-link').on('click',function(){
            if($('.ctc__attributes').find('.all-props__wrap:hidden').length>0){
            $('.ctc__attributes').find('.all-props__wrap:hidden').show();
            $(this).find('span').text('Свернуть');
            }else{
                $('.ctc__attributes').find('.all-props__wrap').hide();
            $('.ctc__attributes').find('.all-props__wrap').slice(0,7).show();
            $(this).find('span').text('Показать все характеристики ');
            }
            })

             var priceElement = $('#result-price{$product->id}');
            var basePrice = parseFloat($('.hidden-price').val());

        function updatePriceNew() {
            var values = parseFloat($('#product-quantity-input').val());
            var _basePrice = basePrice;
            var variants = [];
            var varElements = $('.products-inp_row.id-{$product->id}').find('input[type=\"radio\"]');

            var hasBasePriceVariant = false;

            var newPrice = _basePrice;
            $.each(varElements, function (index, elem) {
                var varId = elem.value;

                if (varId) {
                    var option = $('.products-inp_col.idcol-{$product->id}').find('input[value=\"' + varId + '\"]:checked');
                    var variant = {amount: option.data('amount'), type: option.data('type')};
                    variants.push(variant);
                    switch (variant.type) {
                        case 0: // sum
                        newPrice += variant.amount;
                        newPrice = thousandSeparator(newPrice);

                        break;
                        case 1: // percent
                        newPrice += _basePrice * ( variant.amount / 100);
                        break;
                        case 2:
                        newPrice = variant.amount;
                        newPrice = thousandSeparator(newPrice);

                        break;
                    }
                }
            });
            var span = $(priceElement).find('.pb-main').get(0),
            str = newPrice.replace(' ','');
            console.log(values);
            $(span).html(newPrice);
            $('.spinput_result-sum').html(str*values);

        }
        $('.products-inp_row.id-{$product->id}').find('input[type=\"radio\"]').each(function(){
            var amount = $(this).data('amount');
            if(amount === 0){
                $(this).prop('checked',true);
            }
            })

         $('.products-inp_row.id-{$product->id}').find('input[type=\"radio\"]').change(function () {
            updatePriceNew();
        });
        var thousandSeparator = function(str) {
                var parts = (str + '').split('.'),
                    main = parts[0],
                    len = main.length,
                    output = '',
                    i = len - 1;

                while(i >= 0) {
                    output = main.charAt(i) + output;
                    if ((len - i) % 3 === 0 && i > 0) {
                        output = ' ' + output;
                    }
                    --i;
                }

                if (parts.length > 1) {
                    output += '.' + parts[1];
                }
                return output;
            };
            var attrVal = $('.all-properties .value').each(function(){
                var txt = $(this).html();
                $(this).html(txt.replace('моС','м<small style=\"position:relative;display:inline-block;top:-3px;font-family:PLR;font-size:70%\">о</small>С'));
                })

"); ?>

<?php $this->widget('application.modules.mail.widgets.CallbackEmailWidget', [
  'id' => $product->id,
  'view' => 'callback-product',
  'succesId' => 'succes-product'
]); ?>