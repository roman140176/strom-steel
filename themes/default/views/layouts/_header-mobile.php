<div class="header-mobile">
    <div class="container d-flex container-mob posrel">
        <div class="logo-mobile d-flex">
            <a class="lm__img"  href="/">
                <?= CHtml::image($this->mainAssets . '/images/logo-mob.svg',Yii::app()->getModule('yupe')->siteName) ?>
            </a>
            <div class="lm__name upper">
                <div class="main-name"><span>Стром</span>Трейд</div>
                <a href="tel:+74956643517" class="tel-header-mobile">+7 (495) 664-35-17</a>
                <a href="tel:+74955320720" class="tel-header-mobile">+7 (495) 532-07-20</a>
            </div>
        </div>
        <div class="magnifer">
            <img src="<?= $this->mainAssets.'/images/icon/magnifer.svg'?>" alt="">
        </div>
        <a class="but-favorite toolbar-button" href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>" aria-label="Избранные товары">
            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite.svg'); ?>
            <span class="badge-box but-favorite__count but-header__count <?= (Yii::app()->favorite->count() != null) ? ' active' : ''; ?>" id="yupe-store-favorite-total"><?= Yii::app()->favorite->count();?></span>
        </a>
        <div class="shoppingCart-widget" id="cart-mobile">
            <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
        </div>
        <?php $this->renderPartial('//layouts/_user'); ?>
        <div class="toggler">
            <span></span>
        </div>
    </div>
    <div class="searcher" id="serche-mob">
           <form class="sp-form form" action="/search">
               <div class="input-group">
                        <input class="form-control" placeholder="Я хочу купить..." autocomplete="off" type="text" value="" name="q" id="q">

                        <button type="submit" class="btn-search">
                                <img src="<?= $this->mainAssets.'/images/icon/magnifer.svg'?>" alt="">
                        </button>

                </div>
           </form>
    </div>
</div>
<div class="menu-mobile-box">
    <div class="mmc_close"><i class="fa fa-times" aria-hidden="true"></i></div>
    <div class="catalog-mobile-card">
        <div class="catalog-main-link">
            <span class="catalog-main-link__label">Каталог</span>
            <span class="catalog-main-link__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
        </div>
        <div class="catalog-menu-wrapper">
           <?php $this->widget('application.modules.store.widgets.CategoryWidget'
                ); ?>
        </div>
    </div>
   <?php $this->widget('application.modules.menu.widgets.MenuWidget',
    ['name' => 'top-menu','view' => 'mobile'
        ]); ?>
    <a href="tel:+74956643517" class="tel-header-mobile">+7 (495) 664-35-17</a>
    <a href="tel:+74955320720" class="tel-header-mobile">+7 (495) 532-07-20</a>
    <a href="#" class="call-mob js-button" data-target="#callbackModal" data-toggle="modal"><span>Заказать звонок</span></a>
    <div class="sicial-icons-top">
        <a href="<?= Yii::app()->getModule('yupe')->facebook?>" target="_blank">
           <?= CHtml::image($this->mainAssets . '/images/svg/face.svg','',['class' => 'fc']) ?>
        </a>
        <a href="<?= Yii::app()->getModule('yupe')->vk?>" target="_blank">
           <?= CHtml::image($this->mainAssets . '/images/icon/vk.svg') ?>
        </a>
        <a href="<?= Yii::app()->getModule('yupe')->instagram?>" target="_blank">
            <?= CHtml::image($this->mainAssets . '/images/icon/instagram.svg') ?>
        </a>
    </div>
</div>

