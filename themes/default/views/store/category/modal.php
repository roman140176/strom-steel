<?php
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

// Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/store-frontend.css');
// Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');
/* @var $category StoreCategory */

$this->title =  $category->getMetaTitle();
$this->description = $category->getMetaDescription();
$this->keywords =  $category->getMetaKeywords();
$this->canonical = $category->getMetaCanonical();


?>

<?php
$ids = $category->getProducts();
$products = Product::model()->findAllByPk($ids);
?>
<div class="tabs-hits">
  <?php foreach ($products as $key => $data) : ?>
    <?php if ($data->is_home) : ?>
      <div class="tabs-hits__item" id="<?= $data->getId() ?>">
        <div class="th__item-wrap js-product-item<?= ($data->getIsProductCart() > 0) ? ' item-added' : '' ?>" id="<?= $data->getId() ?>">
          <div class="poc abs">
            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/checkcart.svg'); ?>
          </div>
          <div class="product-box__img">
            <a href="<?= ProductHelper::getUrl($data); ?>" class="product-image<?= $data->category['is_card_big'] ? ' big' : '' ?>">
              <img loading="lazy" src="<?= $data->getImageUrl(270, 199, true, null, 'image') ?>" alt="">
            </a>
            <?php if ($data->is_new) : ?>
              <div class="product-type">
                <?= $data->getAttributeLabel('is_new'); ?>
              </div>
            <?php endif; ?>
            <?php if ($data->is_home) : ?>
              <div class="product-type">
                <?= $data->getAttributeLabel('is_home'); ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="th__item-info">
            <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$data->quantity ?>'>
              <input type="hidden" name="Product[id]" value="<?= $data->id; ?>" />
              <?= CHtml::hiddenField(
                Yii::app()->getRequest()->csrfTokenName,
                Yii::app()->getRequest()->csrfToken
              ); ?>

              <div class="product-box__price product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <?php if ($data->hasDiscount()) : ?>
                  <span class="product-price__old">
                    <div class="discount_box">
                      - <?= round($data->getPercent()) ?>%
                    </div>
                    <div class="price-old">
                      <span class="po-main"> <?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?></span><span class="po-curr"><i class="fa fa-rub" aria-hidden="true"></i>/</span><span class="po-m">м<sup>2</sup></span>
                    </div>

                  </span>
                <?php endif; ?>
                <div class="prices-box">
                  <div class="price-base">
                    <div class="price-result" id="result-price<?= $data->id ?>">
                      <span class="pb-main" itemprop="price">
                        <?= str_replace('.00', '', number_format($data->getResultPrice(), 2, '.', ' ')); ?>
                      </span>
                      <span style="display: none;" itemprop="priceCurrency">RUB</span>
                      <span class="pb-curr"><i class="fa fa-rub" aria-hidden="true"></i></span>

                    </div>
                  </div>
                </div>
              </div>
              <div class="product-box__name">
                <a class="product-name" href="<?= ProductHelper::getUrl($data); ?>">
                  <?= CHtml::encode($data->getName()); ?>
                </a>
              </div>
              <div class="properties intab">
                <?php foreach ($data->getAttributeGroups() as $groupName => $items) : ?>
                  <?php foreach ($items as $attribute) : ?>
                    <?php if ($attribute->is_typ) : ?>
                      <?php if (AttributeRender::renderValue($attribute, $data->attribute($attribute)) != null) : ?>

                        <div class="value_type">
                          <?= AttributeRender::renderValue($attribute, $data->attribute($attribute)); ?>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                    <?php if ($attribute->is_visible) : ?>
                      <?php if (AttributeRender::renderValue($attribute, $data->attribute($attribute)) != null) : ?>
                        <div class="props__wrap">
                          <div class="key">
                            <span><?= $attribute->description; ?>:</span>
                          </div>

                          <div class="value">
                            <?= AttributeRender::renderValue($attribute, $data->attribute($attribute)); ?>
                          </div>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endforeach ?>
                <?php endforeach ?>

              </div>

              <div class="product-box__footer d-flex">
                <a href="<?= ProductHelper::getUrl($data); ?>" class="link-to-product">
                  Подробнее
                  <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/detail.svg'); ?>
                </a>
                <div class="favorits">
                  <a class="toolbar-button" href="">

                    <div class="product-button__item product-favorite">
                      <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                        'product' => $data,
                        'view' => "favorite-item"
                      ]); ?>
                    </div>
                  </a>

                </div>
                <a href="<?= ($data->getIsProductCart()) ? Yii::app()->createUrl('cart/cart/index') : '#'; ?>" class="but-add-cart<?= ($data->getIsProductCart() < 1) ? ' js-but-add-cart ' : ' ' ?>but-product<?= ($data->getIsProductCart() > 0) ? ' added' : '' ?>" id="add-product-to-cart-<?= $data->id ?>" data-product-id="<?= $data->id; ?>" data-cart-add-url="<?= Yii::app()->createUrl('/cart/cart/add'); ?>">
                  <?= CHtml::image($this->mainAssets . '/images/svg/cart.svg') ?>

                </a>
              </div>
              <div class="product-view__hidden hidden">
                <span id="product-result-price"><?= round($data->getResultPrice(), 2); ?></span> x
                <span id="product-quantity">1</span> =
                <span id="product-total-price"><?= round($data->getResultPrice(), 2); ?></span>
                <span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
              </div>

            </form>
          </div>
        </div>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>