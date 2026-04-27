<?php

/* @var $product Product */

$this->title = $product->getMetaTitle();
$this->description = $product->getMetaDescription();
$this->keywords = $product->getMetaKeywords();
$this->canonical = $product->getMetaCanonical();
$mainAssets = Yii::app()->getModule('store')->getAssetsUrl();
$Assets = Yii::app()->getTheme()->getAssetsUrl() . '/images/areas/';

$this->breadcrumbs = array_merge(
  [Yii::t("StoreModule.store", 'Catalog') => ['/store/category/index']],
  $product->category ? $product->category->getBreadcrumbs(true) : [],
  [$product->name]
);
$icons = '';
?>
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
          <div class="drawings d-flex">
            <?php foreach ($product->files as $key => $file) : ?>
              <a href="<?= $file->getFileUrl() ?>" <?= $file->title == 'pdf' ? 'target="_blank"' : '' ?>>
                <div class="<?= $file->title ?>-box"></div>
                <span><?= $file->title == 'pdf' ? 'Чертеж PDF' : 'Чертеж DWG' ?></span>
              </a>
            <?php endforeach ?>
          </div>
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
                      <span class="pb-main" itemprop="price">
                        <?= str_replace('.00', '', number_format($product->getResultPrice(), 2, '.', ' ')); ?>
                      </span>
                      <span style="display: none;" itemprop="priceCurrency">RUB</span>
                      <span class="pb-curr"><i class="fa fa-rub" aria-hidden="true"></i>
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
              <?php if (!empty($product->sku)) : ?>
                <div class="all-props__wrap d-flex">
                  <div class="key">
                    <span>Артикул:</span>
                  </div>

                  <div class="value">
                    <?= $product->sku; ?>
                  </div>
                </div>
              <?php endif ?>
              <?php foreach ($product->getAttributeGroups() as $groupName => $items) : ?>
                <?php foreach ($items as $attribute) : ?>
                  <?php if (AttributeRender::renderValue($attribute, $product->attribute($attribute)) != null) : ?>
                    <?php if ($attribute->id == 4) : ?>
                      <?php $icons = AttributeRender::renderValue($attribute, $product->attribute($attribute)) ?>
                    <?php endif ?>
                    <div class="all-props__wrap d-flex attr-<?= $attribute->id ?>">
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
              <div class="all-props__wrap d-flex">
                <div class="key">
                  <span>Вес(кг):</span>
                </div>

                <div class="value">
                  <?= str_replace('.00', '', number_format($product->weight, 2, '.', ' ')); ?>

                </div>
              </div>
            </div>
            <div class="more-params">Смотреть все параметры</div>
            <h4 class="application-areas">Области применения:</h4>
            <div class="class-icons d-flex">
              <?php $icons = explode('</p>', str_replace('&nbsp;', '', $icons)) ?>
              <?php foreach ($icons as $k => $v) : ?>
                <?php $v = str_replace(['<p>', ' '], '', $v) ?>
                <?php if ($v != '') : ?>
                  <div class="area__item posrel" data-desc="#<?= $v ?>">
                    <div class="area__img">
                      <?= CHtml::image($Assets . $v . '.svg') ?>
                    </div>
                    <div class="area__name">
                      <?= $v ?>
                    </div>
                  </div>
                <?php endif ?>
              <?php endforeach ?>
            </div>
            <div class="area-descriptions hidden">
              <?php $this->widget('application.modules.contentblock.widgets.ContentBlockGroupWidget', [
                'category' => 'classes',
              ]); ?>
            </div>
          </form>
        </div><!--/product-views__info-->
      </div><!--/product-views-->
      <div class="category-tabs-nav d-flex">
        <div class="ctn__link active" data-content="#charapter">Характеристики и Варианты</div>
        <div class="ctn__link" data-content="#linked">Сопутствующие товары</div>
        <div class="ctn__link" data-content="#docs">Сертификаты</div>

      </div>
      <div class="category-tabs-contents">
        <div id="charapter" class="t_content active">
          <div class="child-products-table">
            <?= $product->short_description ?>
          </div>
          <div class="charapter-description">
            <?= $product->description ?>
          </div>
        </div><!--#charapter-->
        <!--#pay-delivery-->
        <div id="linked" class="t_content">
          <div class="container-linked">
            <?php $this->widget('application.modules.store.widgets.LinkedProductsWidget', ['product' => $product, 'code' => null,]); ?>
          </div>
        </div><!--#docs-->

        <div id="docs" class="t_content">
          <?php $cName = $product->category['name'] . '-сертификаты' ?>
          <?php $this->widget('application.modules.gallery.widgets.GalleryNewWidget', [
            'view' => 'productSertificates',
            'name' => $cName,
          ]); ?>
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
        arrows: false,
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
            dots: true,
            arrows: true,
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
        $('.more-params').hide();
        $('.product-views__info .all-props__wrap').hide();
        if($('.product-views__info .all-props__wrap').length>5){
        $('.product-views__info .all-props__wrap').slice(0,4).show();
        $('.more-params').show();
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
        if($('.product-views__info .all-props__wrap:hidden').length>0){
            $('.product-views__info .all-props__wrap:hidden').show();
            $(this).text('Свернуть')
            }else{
                $('.product-views__info .all-props__wrap').hide();
                $('.product-views__info .all-props__wrap').slice(0,4).show();
                $(this).text('Смотреть все параметры')
            }
        })
        if($('.ctc__attributes').find('.all-props__wrap').length>7){
            $('.ctc__attributes').find('.all-props__wrap').hide();
            $('.ctc__attributes').find('.all-props__wrap').slice(0,7).show();
            $('.down-link').removeClass('hidden');
        }

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
                });

            var hoverDesc = $('<div>',{
                class:'area-hover abs'
                });

            hoverDesc.css({
                'width':'250px',
                'padding':'10px',
                'fontSize':'14px',
                'zIndex':'50',
                // 'top':'-50px',
                'left':'-125px',
                'background':'#fff',
                'box-shadow':'0 0 10px rgba(0,0,0,.2)'
                })
            $('.area__item').on('mouseenter',function(){
                var id = $(this).data('desc'),
                    contentDesc = $(id).html()
                $(this).append(hoverDesc.html(contentDesc));
                hoverDesc.css({
                    'top':-hoverDesc.innerHeight()
                    })
                });
            $('.area__item').on('mouseleave',function(){
                var id = $(this).data('desc');
                hoverDesc.remove()
                });
            $('.child-products-table table tr').each(function(){
                var td = $(this).find('td:last')
                td.find('a').each(function(){
                    $(this).attr('target','_blank');
                    var href = $(this).attr('href');
                    var ext = href.split('.');
                    var L = ext.length-1;
                    var extName = ext[L].toLowerCase();
                    if(extName == 'pdf'){
                         $(this).addClass('pdf-box');
                            }else{
                              $(this).addClass('dwg-box')
                              .removeAttr('target');
                            }
                    })
                var prevLast = td.prev().get(0);
                order = $(prevLast).find('a');
                order.on('click',function(e){
                    e.preventDefault();
                    $.getScript('https://www.google.com/recaptcha/api.js', function () {});
                    $('#order-modal').modal('show')
                    var tr = $(this).parents('tr').get(0);
                    var td = $(tr).find('td:eq(1)');
                    var name = $(td).text();
                    $('#nameProduct').val(name)
                    })
                });




"); ?>

<?php $this->widget('application.modules.mail.widgets.CallbackEmailWidget', [
  'id' => $product->id,
  'view' => 'callback-product',
  'succesId' => 'succes-product'
]);
$this->widget('application.modules.mail.widgets.ContactInnerWidget');
?>