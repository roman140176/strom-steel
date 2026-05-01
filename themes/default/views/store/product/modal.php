<?php

/* @var $product Product */

$this->title = $product->getMetaTitle();
$this->description = $product->getMetaDescription();
$this->keywords = $product->getMetaKeywords();
$this->canonical = $product->getMetaCanonical();
Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/swup.min.js');
Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slick.min.js');
Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/fancy.js',CClientScript::POS_END);
$mainAssets = Yii::app()->getModule('store')->getAssetsUrl();

?>
<?php $positions = Yii::app()->cart->getPositions() ?>

    <div class="container container-product-mini" data-id="add-product-to-cart-<?= $product->id?>">
        <div class="product-views modal-views">
            <div class="mini-product-view__img">
                <div class="mini__main">
                    <div class="cli-check cli-red">
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/wc.svg'); ?>
                </div>
                <div class="cat-name-modal">
                    <?= $product->category['name']?>
                </div>
                </div>
                <div class="mp-preview__img-box">
                    <img src="<?= $product->getImageUrl(112,90,true)?>"/>
                </div>
                <div class="mini-info">
                    <h5 class="title-mini" itemprop="name"><?= CHtml::encode($product->getTitle()); ?></h5>
                <?php $producer = Producer::model()->findByPk($product->producer_id) ?>
                        <div class="properties">
                            <?php foreach ($product->getAttributeGroups()as $groupName => $items): ?>
                             <?php foreach ($items as $attribute): ?>
                                 <?php if ($attribute->is_visible): ?>
                                     <div class="key">
                                        <span><?= CHtml::encode($attribute->title); ?>:</span>
                                     </div>

                                    <div class="value">
                                        <?= AttributeRender::renderValue($attribute, $product->attribute($attribute)); ?>
                                    </div>
                                 <?php endif ?>
                             <?php endforeach ?>
                            <?php endforeach ?>
                            <div class="key">
                                <span>бренд:</span>
                            </div>
                            <div class="value">
                                <?= $producer['name']?>
                            </div>
                        </div>
                </div>
            </div>
            <div class="product-view__info info__modal">

                  <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$product->quantity ?>' class="preview-box-form" id="form-<?= $product->id?>">
                        <input type="hidden" name="Product[id]" value="<?= $product->id; ?>"/>
                        <?= CHtml::hiddenField(
                            Yii::app()->getRequest()->csrfTokenName,
                            Yii::app()->getRequest()->csrfToken
                        ); ?>

                            <div class="product-view__bot product-view__modal">
                                <div class="product-view__price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    <input type="hidden" id="base-price" value="<?= round($product->getResultPrice(), 2); ?>"/>
                                    <div class="canvas-price canvas-pr" data-id="complect-price-<?=$product->id?>">
                                            <div class="product-prices <?= ($product->hasDiscount()) ? 'product-price-new' : '' ?>">

                                                <?php if ($product->hasDiscount()) : ?>
                                                    <span class="product-price__old on-view-page">
                                                        <div class="discount_box">
                                                            <?= round($product->getPercent())?>%
                                                        </div>
                                                        <span class="price-old">
                                                            <?= str_replace('.00', '', number_format($product->getBasePrice(), 2, '.', ' ')); ?><?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble-old.svg'); ?>
                                                        </span>

                                                    </span>
                                                <?php endif; ?>

                                                    <div class="sum__price-modal" data-input="in-<?= $product->id?>" id="complect-price-<?=$product->id?>">
                                                        <span><?= round($product->getResultPrice(), 2); ?></span><?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?>
                                                    </div>

                                                    <span class="cpm complect-price-<?=$product->id?>" itemprop="price"><?= round($product->getResultPrice(), 2); ?></span>
                                                <meta itemprop="priceCurrency" content="<?= Yii::app()->getModule('store')->currency?>">
                                                    <?= $product->isInStock() ? '<link itemprop="availability" href="http://schema.org/InStock">' : '<link itemprop="availability" href="http://schema.org/PreOrder">';?>
                                            </div>
                                            <div class="inStock-mini">
                                                <?php if ($product->in_stock == 1): ?>
                                                    Товар в наличии
                                                    <?php else: ?>
                                                    Под заказ
                                                <?php endif ?>
                                            </div>
                                    </div>
                                </div>
                                <div class="price-construct mod_prod">
                                    <div class="product-view__spinput">
                                            <?php
                                                $minQuantity = 1;
                                                $maxQuantity = Yii::app()->getModule('store')->controlStockBalances ? $data->getAvailableQuantity() : 99;
                                                $productCart = isset($positions["product_".$product->id."_"]) ? $positions["product_".$product->id."_"] : null;
                                                $quantity = $productCart ? $productCart->getQuantity() : 1;
                                            ?>
                                            <span data-min-value='<?= $minQuantity; ?>' data-max-value='<?= $maxQuantity; ?>' class="spinput js-spinput">
                                                <span class="spinput__minus js-spinput__minus product-quantity-decrease">
                                                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/minus.svg'); ?>
                                                </span>
                                                <input name="Product[quantity]" value="<?= $quantity ?>" class="spinput__value sp-modal product-quantity-input"
                                                       id="in-<?= $product->id?>"/>
                                                <span class="spinput__plus js-spinput__plus product-quantity-increase">
                                                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/plus.svg'); ?>
                                                </span>
                                            </span>
                                    </div>
                                </div>
                                <!-- //********* -->

                                    <div class="product-view__hidden hidden">
                                        <span id="product-result-price"><?= round($product->getResultPrice(), 2); ?></span> x
                                        <span id="product-quantity">1</span> =
                                        <span id="product-total-price"><?= round($product->getResultPrice(), 2); ?></span>
                                        <span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                                    </div>
                            </div>
                             <button class="but-add-cart js-cart-view-modal but-product hidden" id="add-product-to-cart-<?= $product->id?>">
                                    <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/cart-white.svg') ?>
                                  <span>Купить</span>
                            </button>
                        </form>
                    <div class="del-mini-product">
                        <span>Удалить</span>
                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/del.svg'); ?>
                    </div>
            </div>
        </div>
    </div>

