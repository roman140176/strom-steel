<?php $positions = Yii::app()->cart->getPositions() ?>
<?php $varIds = []; ?>
<?php foreach ($positions as $key => $pos) : ?>
  <?php foreach ($pos->selectedVariants as $k => $var) : ?>
    <?php
    array_push($varIds, $var->id)
    ?>
  <?php endforeach ?>
<?php endforeach ?>
<?php
$varId = implode('_', $varIds);
?>
<div class="tabs-hits__item">
  <div class="th__item-wrap white js-product-item<?= ($data->getIsProductCart() > 0) ? ' item-added' : '' ?>" id="<?= $data->getId() ?>">
    <div class="poc abs">
      <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/checkcart.svg'); ?>
    </div>
    <div class="product-box__img">
      <a href="<?= ProductHelper::getUrl($data); ?>" class="product-image<?= $data->category['is_card_big'] ? ' big' : '' ?>">
        <img loading="lazy" src="<?= $data->getImageUrl(215, 151, true, null, 'image') ?>" alt="">
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
      <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$data->quantity ?>' class="d-flex form_item-list">
        <input type="hidden" name="Product[id]" value="<?= $data->id; ?>" />
        <?= CHtml::hiddenField(
          Yii::app()->getRequest()->csrfTokenName,
          Yii::app()->getRequest()->csrfToken
        ); ?>
        <?php if ($data->getResultPrice() > 0) : ?>
          <div class="product-box__price product-price pr__mob" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <?php if ($data->hasDiscount()) : ?>
              <span class="product-price__old">
                <div class="discount_box">
                  - <?= round($data->getPercent()) ?>%
                </div>
                <div class="price-old">
                  <span class="po-main"> <?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?></span><span class="po-curr"><i class="fa fa-rub" aria-hidden="true"></i>

                    <?php if (!empty($data->category['units'])) : ?>
                      /
                    <?php endif ?>
                  </span>
                  <span class="po-m">
                    <?php if (!empty($data->category['units'])) : ?>
                      <?= $data->category['units'] ?>
                    <?php endif ?>
                  </span>
                </div>

              </span>
            <?php endif; ?>
            <div class="prices-box">
              <div class="price-base">
                <div class="price_small_title">Цена:</div>
                <div class="price-result" id="result-price<?= $data->id ?>">
                  <span class="pb-main" itemprop="price">
                    <?= str_replace('.00', '', number_format($data->getResultPrice(), 2, '.', ' ')); ?>
                  </span>
                  <span style="display: none;" itemprop="priceCurrency">RUB</span>
                  <span class="pb-curr"><i class="fa fa-rub" aria-hidden="true"></i>
                    <?php if (!empty($data->category['units'])) : ?>
                      /
                    <?php endif ?>
                  </span>
                  <span class="pb-m">
                    <?php if (!empty($data->category['units'])) : ?>
                      <?= $data->category['units'] ?>
                    <?php endif ?>

                  </span>

                </div>
              </div>
            </div>
          </div>
        <?php endif ?>
        <div class="info-flex">
          <div class="product-box__name">
            <a class="product-name" href="<?= ProductHelper::getUrl($data); ?>">
              <?= CHtml::encode($data->getName()); ?>
            </a>
          </div>
          <div class="product-box-desc">
            <div class="properties">
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
                  <?php if ($data->category['id'] == 38 && AttributeRender::renderValue($attribute, $data->attribute($attribute)) != null) : ?>
                    <?php if ($attribute->id == 4 || $attribute->id == 1) : ?>
                      <div class="props__wrap">
                        <div class="key">
                          <span>
                            <?php if ($attribute->id == 4) : ?>
                              К/н:
                            <?php else : ?>
                              шгс:
                            <?php endif ?>
                          </span>
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
            <a href="<?= ProductHelper::getUrl($data); ?>" class="detail-desc">
              Подробное описание
              <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/toleft.svg'); ?>
            </a>
          </div>
        </div>
        <div class="info-right">
          <?php if ($data->getResultPrice() > 0) : ?>
            <div class="product-box__price product-price pr__desk" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
              <?php if ($data->hasDiscount()) : ?>
                <span class="product-price__old">
                  <div class="discount_box">
                    - <?= round($data->getPercent()) ?>%
                  </div>
                  <div class="price-old">
                    <span class="po-main"> <?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?></span><span class="po-curr"><i class="fa fa-rub" aria-hidden="true"></i>

                      <?php if (!empty($data->category['units'])) : ?>
                        /
                      <?php endif ?>
                    </span>
                    <span class="po-m">
                      <?php if (!empty($data->category['units'])) : ?>
                        <?= $data->category['units'] ?>
                      <?php endif ?>
                    </span>
                  </div>

                </span>
              <?php endif; ?>
              <div class="prices-box">
                <div class="price-base">
                  <div class="price_small_title">Цена:</div>
                  <div class="price-result" id="result-price<?= $data->id ?>">
                    <span class="pb-main" itemprop="price">
                      <?= str_replace('.00', '', number_format($data->getResultPrice(), 2, '.', ' ')); ?>
                    </span>
                    <span style="display: none;" itemprop="priceCurrency">RUB</span>
                    <span class="pb-curr"><i class="fa fa-rub" aria-hidden="true"></i>
                      <?php if (!empty($data->category['units'])) : ?>
                        /
                      <?php endif ?>
                    </span>
                    <span class="pb-m">
                      <?php if (!empty($data->category['units'])) : ?>
                        <?= $data->category['units'] ?>
                      <?php endif ?>

                    </span>

                  </div>
                </div>
              </div>
            </div>
          <?php endif ?>
          <div class="product-box__footer d-flex f__dsk">
            <a href="<?= ProductHelper::getUrl($data); ?>" class="link-to-product">
              Подробнее
              <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/detail.svg'); ?>
            </a>
            <?php if ($data->getResultPrice() > 0) : ?>
              <a href="<?= ($data->getIsProductCart()) ? Yii::app()->createUrl('cart/cart/index') : '#'; ?>" class="but_list but-add-cart<?= ($data->getIsProductCart() < 1) ? ' js-but-add-cart ' : ' ' ?>but-product<?= ($data->getIsProductCart() > 0) ? ' added' : '' ?>" id="add-product-to-cart-<?= $data->id ?>" data-product-id="<?= $data->id; ?>" data-cart-add-url="<?= Yii::app()->createUrl('/cart/cart/add'); ?>">
                <?= CHtml::image($this->mainAssets . '/images/svg/cart.svg') ?>
                <?php if ($data->getIsProductCart() < 1) : ?>
                  <span>Купить</span>
                <?php else : ?>
                  <span>В корзине</span>
                <?php endif ?>

              </a>
            <?php endif ?>
            <div class="favorits">
              <a class="toolbar-button" href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>">

                <div class="product-button__item product-favorite">
                  <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                    'product' => $data,
                    'view' => "favorite-item"
                  ]); ?>
                </div>
              </a>

            </div>
          </div>
        </div>
        <div class="product-box__footer d-flex f__mob">
          <a href="<?= ProductHelper::getUrl($data); ?>" class="link-to-product">
            Подробнее
            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/detail.svg'); ?>
          </a>
          <?php if ($data->getResultPrice() > 0) : ?>
            <button class="but-add-cart js-but-add-cart but-product" id="add-product-to-cart-<?= $data->id ?>">
              <?= CHtml::image($this->mainAssets . '/images/svg/cart.svg') ?>
              <span>Купить</span>
            </button>
          <?php else : ?>
            <div class="to-order">
              Под заказ
            </div>
          <?php endif ?>
          <div class="favorits">
            <a class="toolbar-button" href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>">

              <div class="product-button__item product-favorite">
                <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                  'product' => $data,
                  'view' => "favorite-item"
                ]); ?>
              </div>
            </a>

          </div>
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