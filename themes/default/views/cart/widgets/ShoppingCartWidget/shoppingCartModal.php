<?php
$currency = Yii::app()->getModule('store')->currency;
?>
<div class="but-cart js-cart" id="cart-widget" data-cart-widget-url="<?= Yii::app()->createUrl('/cart/cart/widget'); ?>">
    <?php if (empty(Yii::app()->cart->isEmpty())): ?>
        <a class="" href="<?= Yii::app()->createUrl('/cart/cart/index') ?>">
    <?php endif; ?>
        <div class="but-cart__icon but-header__icon">
            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cart.svg'); ?>
       <?php if (empty(Yii::app()->cart->isEmpty())): ?>
            <div class="badge-box but-header__count <?= (empty(Yii::app()->cart->isEmpty())) ? 'active' : ''; ?>">
               <?= Yii::app()->cart->getItemsCount(); ?>/<?= Yii::app()->cart->getCost(); ?>
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/ruble.svg'); ?>
            </div>
        <?php endif; ?>
            <div class="badge-box__count">
                <?= Yii::app()->cart->getItemsCount(); ?>
            </div>
        </div>
        <?php if (!empty(Yii::app()->cart->isEmpty())): ?>
            <div class="badge-box">
                <?= Yii::t("CartModule.cart", "Корзина"); ?>
                <?= $position->name?>
            </div>
        <?php endif; ?>
    <?php if (empty(Yii::app()->cart->isEmpty())): ?>
        </a>
    <?php endif; ?>
</div>

