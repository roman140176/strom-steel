<?php
$assetsUrl = Yii::app()->getTheme()->getAssetsUrl();
$assetsPath = '.' . $assetsUrl;
?>
<div class="header-wrap">
    <header class="container header-top__inner">
        <a href="/" class="logo-header">
            <?= CHtml::image($this->mainAssets . '/images/logo.svg') ?>
        </a>

        <div class="searcher">
            <?php $this->widget('application.modules.store.widgets.SearchProductWidget'); ?>
        </div>

        <div class="header-contact header-contact--phone">
            <span class="header-contact__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
            </span>
            <span class="header-contact__body">
                <a href="tel:+74956643517" class="header-contact__value" onclick="if (typeof yaCounter68294278 !== 'undefined') { yaCounter68294278.reachGoal('show-phone'); }">+7 (495) 664-35-17</a>
                <a href="tel:+74955320720" class="header-contact__value header-contact__value--secondary" onclick="if (typeof yaCounter68294278 !== 'undefined') { yaCounter68294278.reachGoal('show-phone'); }">+7 (495) 532-07-20</a>
            </span>
        </div>

        <a href="#" class="header-contact header-contact--callback js-button" data-target="#CallbackFormEmail" data-toggle="modal">
            <span class="header-contact__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3v5z"/>
                    <path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3v5z"/>
                </svg>
            </span>
            <span class="header-contact__body">
                <span class="header-contact__label">Поддержка</span>
                <span class="header-contact__value header-contact__value--accent">Заказать звонок</span>
            </span>
        </a>
    </header>
</div>

<div class="header-bottom container posrel">
    <div class="catalog-link-main posrel">
        <?= file_get_contents($assetsPath . '/images/icon/burger.svg'); ?>
        <span>Каталог товаров</span>
        <?= file_get_contents($assetsPath . '/images/icon/gal.svg'); ?>

        <?php $this->widget('application.modules.store.widgets.CategoryWidget', ['depth' => 1, 'view' => 'tree']); ?>
    </div>

    <nav class="header-nav">
        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu']); ?>
    </nav>

    <div class="header-favorite">
        <a class="but-favorite" href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>" aria-label="Избранные товары">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            <span class="badge-box but-favorite__count but-header__count <?= (Yii::app()->favorite->count() != null) ? ' active' : ''; ?>" id="yupe-store-favorite-total"><?= Yii::app()->favorite->count(); ?></span>
            <div class="cfn favorite-name">
                Избранные<br>товары
            </div>
        </a>
    </div>

    <?php $this->renderPartial('//layouts/_user'); ?>

    <div id="shopping-cart-widget" class="shoppingCart-widget">
        <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
    </div>
</div>

<?php $this->renderPartial('//layouts/_header-mobile'); ?>

<?php Yii::app()->clientScript->registerScript("submenu", "
    $('.menu-catalog-submenu').each(function(){
        var h = $('#menu-catalog').innerHeight();
        var el = $(this);
        var u = el.find('ul');
        el.css('height', h);
        u.css('height', h);
        u.attr('data-simplebar',true);
        u.attr('data-simplebar-auto-hide',false);
        })
"); ?>
