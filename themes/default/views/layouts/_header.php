<!-- <noindex>
  <div class="warning">
    <div class="container">
      Уважаемые клиенты! В связи с нестабильным курсом валют, цены на товар отличаются. Актуальные цены уточняйте у менеджеров по тф.+7 (495) 532-07-20
    </div>
  </div>
</noindex> -->
<style>
  .warning {
    padding: 10px 0;
    background: #ffe033;
  }
</style>
<div class="header-wrap">
  <header class="container">
    <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu']); ?>
    <div class="sicial-icons-top">
      <a href="<?= Yii::app()->getModule('yupe')->facebook ?>" target="_blank">
        <?= CHtml::image($this->mainAssets . '/images/svg/face.svg', '', ['class' => 'fc']) ?>
      </a>
      <a href="<?= Yii::app()->getModule('yupe')->vk ?>" target="_blank">
        <?= CHtml::image($this->mainAssets . '/images/icon/vk.svg') ?>
      </a>
      <a href="<?= Yii::app()->getModule('yupe')->instagram ?>" target="_blank">
        <?= CHtml::image($this->mainAssets . '/images/icon/instagram.svg') ?>
      </a>
    </div>
    <div class="header__info">
      <a href="" class="tel-header show-phone" onclick="yaCounter68294278.reachGoal('show-phone');">+7 (495) <span>Показать</span></a>
      <div class="tel-header-group hidden">
        <a href="tel:+74956643517" class="tel-header">+7 (495) 664-35-17</a>
        <a href="tel:+74955320720" class="tel-header">+7 (495) 532-07-20</a>
      </div>
      <div class="wmode"><span><?= Yii::app()->getModule('yupe')->wmode ?></span></div>
    </div>
    <div class="header__info mail__info">
      <a href="mailTo:<?= Yii::app()->getModule('yupe')->email ?>" class="mail-header"><?= Yii::app()->getModule('yupe')->email ?></a>
      <a href="#" class="wmode js-button" data-target="#CallbackFormEmail" data-toggle="modal">
        <span>написать нам</span>
      </a>
    </div>
    <?php $this->renderPartial('//layouts/_user'); ?>
  </header>
</div>
<div class="header-bottom container posrel">
  <a href="/" class="logo-header">
    <?= CHtml::image($this->mainAssets . '/images/logo.svg') ?>
  </a>
  <div class="catalog-link-main posrel">
    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/burger.svg'); ?>
    <span>Каталог товаров</span>
    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/gal.svg'); ?>

    <?php $this->widget('application.modules.store.widgets.CategoryWidget', ['depth' => 1, 'view' => 'tree']); ?>
  </div>
  <div class="searcher">
    <?php $this->widget('application.modules.store.widgets.SearchProductWidget'); ?>
  </div>
  <div class="header-favorite">
    <a class="but-favorite" href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>" class="toolbar-button">
      <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite.svg'); ?>
      <span class="badge-box but-favorite__count but-header__count <?= (Yii::app()->favorite->count() != null) ? ' active' : ''; ?>" id="yupe-store-favorite-total"><?= Yii::app()->favorite->count(); ?></span>
      <div class="cfn favorite-name">
        Избранные<br>товары
      </div>
    </a>
  </div>
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