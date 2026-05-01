<?php
$currency = Yii::app()->getModule('store')->currency;
$money = Yii::app()->getComponent('money');
?>
<script type="text/javascript">
    var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
    var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
    var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    var yupeCartEmptyMessage = '<h1><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1><?= Yii::t("CartModule.cart", "There are no products in cart"); ?>';
</script>
<div class="but-cart js-cart d-flex" id="cart-widget" data-cart-widget-url="<?= Yii::app()->createUrl('/cart/cart/widget'); ?>">
        <a class="cart-header" href="<?= Yii::app()->createUrl('/cart/cart/index') ?>" aria-label="Корзина покупок">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="9" cy="21" r="1"/>
                <circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
            <div class="cart_bb badge-box<?= (empty(Yii::app()->cart->isEmpty())) ? ' active' : ''?>">
              <?= Yii::app()->cart->getItemsCount(); ?>
            </div>
        <span class="cfn cart-name">
            Корзина<br>
            покупок
        </span>
        </a>
<?php if (Yii::app()->request->pathInfo != 'cart'): ?>

<div class="cart-mini abs" id="cart-mini">
                <?php if (Yii::app()->cart->isEmpty()): ?>
                    <p><?= Yii::t('CartModule.cart', 'There are no products in cart'); ?></p>
                <?php else: ?>
                    <div class="cm__inner" data-simplebar data-simplebar-auto-hide="false">
                    <?php foreach (Yii::app()->cart->getPositions() as $product): ?>
                        <?php 
                            $productCurrency = $product->getCurrency();
                            $price = $productCurrency ? $money->convert(str_replace('.00', '',$product->getResultPrice()), $productCurrency) : $product->getResultPrice(); 
                            $sumPrice = $product->getSumPrice(); 
                        ?>
                        <div class="cart-mini__item js-cart__item" id="<?= $product->getId(); ?>">
                                    <div class="thumbnail__wrap d-flex">
                                        <div class="cart-mini__thumbnail">
                                        <img src="<?= $product->getImageUrl(60, 60, false); ?>" class="cart-mini__img"/>
                                        </div>
                                        <div class="cart-mini__delete-btn js-cart__delete mini-cart-delete-product" data-position-id="<?= $product->getId(); ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    </div>
                                    <div class="cm__name"><?= $product->name?></div>
                                    <div class="cart-mini__info">
                                        <div class="cart-mini__title">
                                            <?= CHtml::link($product->title, ProductHelper::getUrl($product),
                                                ['class' => 'cart-mini__link']); ?>
                                        </div>
                                        <div class="cart-mini__base-price">
                                            <?= $price ?>
                                            <span class="ruble"><?= Yii::t('CartModule.cart', $currency); ?></span>
                                            <?php if ($productCurrency): ?>
                                             (<?= $product->getResultPrice() ?> <span class="ruble"><?= $productCurrency ?></span>)
                                            <?php endif; ?>
                                            <?= $product->getQuantity(); ?> <?= Yii::t('CartModule.cart', 'pcs'); ?>
                                            <div class="cost__flex d-flex">
                                                <span>на сумму &nbsp;</span>
                                                <div class="product-price">
                                                    <?= $sumPrice; ?>
                                                    <span class="ruble"><?= Yii::t('CartModule.cart', $currency); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="cart-mini__bottom">
                        <a href="<?= Yii::app()->createUrl('cart/cart/index'); ?>" class="btn btn_success">
                            <?= Yii::t('CartModule.cart', 'Make an order'); ?>
                        </a>
                    </div>
                <?php endif; ?>
</div>
<?php endif ?>

</div>