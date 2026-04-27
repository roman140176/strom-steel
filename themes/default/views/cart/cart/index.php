<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

$this->title = Yii::t('CartModule.cart', 'Cart');
$this->breadcrumbs = [
    Yii::t("CartModule.cart", 'Cart')
];
$money = Yii::app()->getComponent('money');
?>


<script type="text/javascript">
    var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
    var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
    var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    var yupeCartEmptyMessage = '<h1><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1><?= Yii::t("CartModule.cart", "There are no products in cart"); ?>';
</script>

<div class="page-content">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <div class="main__title">
        <h1 class="page_title"><?= Yii::t("CartModule.cart", "Cart"); ?></h1>
        </div>
        <?php if (Yii::app()->cart->isEmpty()): ?>
            <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
        <?php else: ?>

            <?php $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'action' => ['/order/order/create'],
                    'id' => 'order-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'clientOptions' => [
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'validateOnType' => false,
                        'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                        'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false); return !hasError;}',
                    ],
                    'htmlOptions' => [
                        'hideErrorMessage' => false,
                        'class' => 'order-form form-my',
                    ]
                ]
            );
            ?>
            <div class="cart-block">
                <div class="order-box js-cart">
                    <div class="order-box__header order-box__header_black">
                        <div class="cart-list-header">
                            <div class="cart-list__column cart-list__column_info">Товар</div>
                            <div class="cart-list__column cart-list__column_price"><?= Yii::t("CartModule.cart", "Price"); ?></div>
                            <div class="cart-list__column"><?= Yii::t("CartModule.cart", "Amount"); ?></div>
                            <div class="cart-list__column cart-list__column_sum"><?= Yii::t("CartModule.cart", "Sum"); ?></div>
                        </div>
                    </div>


                    <div class="cart-list">
                        <?php foreach ($positions as $position): ?>
                            <?php 
                                $productCurrency = $position->getProductModel()->getCurrency();
                                $positionPrice = $position->getPrice();
                                $positionSumPrice = $position->getSumPrice();
                            ?>
                            <div class="cart-list__item">
                                <?php $positionId = $position->getId(); ?>
                                <?php $productUrl = ProductHelper::getUrl($position->getProductModel()); ?>
                                <?= CHtml::hiddenField('OrderProduct['.$positionId.'][product_id]', $position->id); ?>
                                <input type="hidden" class="position-id" value="<?= $positionId; ?>"/>
                                <div class="cart-item js-cart__item">
                                    <div class="cart-item__info" data-text='Товар'>
                                        <div class="cart-item__thumbnail">
                                            <img src="<?= $position->getProductModel()->getImageUrl(90, 90, false); ?>"
                                                 class="cart-item__img"/>
                                        </div>
                                        <div class="cart-item__content grid-module-4">
                                            <?php if ($position->getProductModel()->getCategoryId()): ?>
                                                <div class="cart-item__category"><?= $position->getProductModel(
                                                    )->category->name ?></div>
                                            <?php endif; ?>
                                            <div class="cart-item__title">
                                                <a href="<?= $productUrl; ?>" class="cart-item__link"><?= CHtml::encode(
                                                        $position->name
                                                    ); ?></a>
                                            </div>
                                            <?php foreach ($position->selectedVariants as $variant): ?>
                                                <h6><?= $variant->attribute->title; ?>: <?= $variant->getOptionValue(); ?></h6>
                                                <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][variant_ids][]', $variant->id); ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="cart-item__price" data-text='<?= Yii::t("CartModule.cart", "Price"); ?>'>
                                        <span class="position-price"><?= $positionPrice; ?></span>
                                        <span class="ruble"> <?= Yii::t("CartModule.cart", Yii::app()->getModule('store')->currency); ?></span>
                                        <?php if ($productCurrency): ?>
                                            <br>(<span class="position-price-2"><?= str_replace('.00', '', number_format($position->getProductModel()->getResultPrice(), 2, '.', ' ')) ?></span>
                                            <span> <?= $productCurrency ?></span>)
                                        <?php endif ?>
                                    </div>
                                    <div class="cart-item__quantity" data-text='<?= Yii::t("CartModule.cart", "Amount"); ?>'>
                                        <div class="cart-item__spinput">
                                            <span data-min-value='1' data-max-value='99' class="spinput js-spinput cart_spinput">
                                                <span class="spinput__minus js-spinput__minus cart-quantity-decrease"
                                                      data-target="#cart_<?= $positionId; ?>">
                                                          <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/minus.svg'); ?>
                                                      </span>
                                                <?= CHtml::textField(
                                                    'OrderProduct['.$positionId.'][quantity]',
                                                    $position->getQuantity(),
                                                    ['id' => 'cart_'.$positionId, 'class' => 'spinput__value position-count']
                                                ); ?>
                                                <span class="spinput__plus js-spinput__plus cart-quantity-increase"
                                                      data-target="#cart_<?= $positionId; ?>">
                                                          <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/plus.svg'); ?>
                                                      </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="cart-item__summ" data-text='<?= Yii::t("CartModule.cart", "Sum"); ?>'>
                                        <span class="position-sum-price"><?= $positionSumPrice; ?></span>
                                        <span class="ruble"> <?= Yii::t("CartModule.cart", Yii::app()->getModule('store')->currency); ?></span>

                                        <div class="cart-item__action">
                                            <a class="js-cart__delete cart-delete-product"
                                               data-position-id="<?= $positionId; ?>">
                                                <i class="fa fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!empty($deliveryTypes)): ?>
                        <div class="order-box">
                            <h3><?= Yii::t(
                                    "CartModule.cart",
                                    "Delivery method"
                                ); ?></h3>
                            <div class="order-box__body">
                                <div class="order-box-delivery">
                                    <div class="order-box-delivery__type">
                                        <?php foreach ($deliveryTypes as $key => $delivery): ?>
                                            <div class="rich-radio">
                                                <input type="radio" name="Order[delivery_id]"
                                                       id="delivery-<?= $delivery->id; ?>"
                                                       class="rich-radio__input"
                                                       value="<?= $delivery->id; ?>"
                                                       data-price="<?= $delivery->price; ?>"
                                                       data-free-from="<?= $delivery->free_from; ?>"
                                                       data-available-from="<?= $delivery->available_from; ?>"
                                                       data-separate-payment="<?= $delivery->separate_payment; ?>">
                                                <label for="delivery-<?= $delivery->id; ?>" class="rich-radio__label">
                                                    <div class="rich-radio-body">
                                                        <div class="rich-radio-body__content">
                                                            <div class="rich-radio-body__heading">
                                                                <span class="rich-radio-body__title">
                                                                    <?= $delivery->name; ?>
                                                                    <?php /*= $delivery->price; ?> <?= Yii::t(
                                                                        "CartModule.cart",
                                                                        Yii::app()->getModule('store')->currency
                                                                    );*/ ?>
                                                                </span>
                                                            </div>
                                                            <div
                                                                class="rich-radio-body__text"><?= $delivery->description; ?></div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                            <h3>Выберите способ оплаты</h3>
                                <?php $payment = Payment::model()->findAll(); ?>
                                <?php if ($payment) : ?>
                                    <div class="payment-method">
                                        <ul class="payment-method__lists" id="payment-methods">
                                            <?php foreach ($payment as $payment) : ?>
                                                <li class="payment-method__list">
                                                    <input class="payment-method-radio"
                                                           type="radio"
                                                           name="Order[payment_method_id]"
                                                           value="<?= $payment->id; ?>"
                                                           checked=""
                                                           id="payment-<?= $payment->id; ?>">
                                                    <label for="payment-<?= $payment->id; ?>">
                                                        <?= CHtml::encode($payment->name); ?>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                        <div class="order-box-delivery__address">
                                        <h3 class="client-head">Заполните форму для оформления заказа</h3>

                                        <div class="order-form__body">
                                            <div class="order-form__inputs">
                                                <?= $form->textFieldGroup($order, 'name'); ?>
                                                <?= $form->textFieldGroup($order, 'email'); ?>
                                                <div class="form-group">
                                                    <?= $form->labelEx($order, 'phone', ['class' => 'control-label']) ?>
                                                    <?php $this->widget('CMaskedTextFieldPhone', [
                                                        'model' => $order,
                                                        'attribute' => 'phone',
                                                        'mask' => '+7-999-999-9999',
                                                        'htmlOptions'=>[
                                                            'class' => 'data-mask form-control',
                                                            'data-mask' => 'phone',
                                                            'placeholder' => 'Ваш телефон',
                                                            'autocomplete' => 'off'
                                                        ]
                                                    ]) ?>
                                                    <?php echo $form->error($order, 'phone'); ?>
                                                </div>
                                                <?= $form->textFieldGroup($order, 'street'); ?>
                                            </div>
                                            <div class="order-form__comment">
                                            <?= $form->textAreaGroup($order, 'comment'); ?>
                                            </div>
                                        </div>
                                    </div>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <?= Yii::t("CartModule.cart", "Delivery method aren't selected! The ordering is impossible!") ?>
                        </div>
                    <?php endif; ?>
                    <div class="order-box__bottom">
                        <div class="cart-box__subtotal">
                            <span class="title_elem">Итого:</span> &nbsp;<span id="cart-total-product-count"><?= Yii::app()->cart->getItemsCount(); ?></span>&nbsp;
                            <span class="product-on-sum"> товар(ов) на сумму &nbsp;</span>
                           <span id="cart-full-cost-with-shipping">0</span><span class="ruble"> <?= Yii::t(
                                    "CartModule.cart",
                                    Yii::app()->getModule('store')->currency
                                ); ?></span>
                        </div>
                        <div class="cart-box__order-button">
                            <div class="agreement d-flex">
                                <input type="checkbox" id="check-agreement" checked>
                                <label for="check-agreement">
                                </label>
                                <div class="agreement-text">
                                Я прочитал <a href="/usloviya-soglasheniya" target="_blank"> "Условия
                                соглашения" </a> и согласен с условиями
                                </div>
                            </div>
                            <button type="submit" class="but but-order-submit">Оформить заказ</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        <?php endif; ?>
    </div>
</div>
<?php Yii::app()->clientScript->registerScript("street", "
    $('#Order_street').on('input',function(){
         $('.emty-adres').remove();
         $('#Order_street').parents('.form-group').removeClass('has-error');
        })
    $('#Order_street').parents('.form-group').hide();
    $('.rich-radio input').on('change',function(){
        if($(this).attr('id')=='delivery-1' && $(this).is(':checked')){
            $('#Order_street').parents('.form-group').hide();
            }else{
              $('#Order_street').parents('.form-group').show();
            }
        });
    $('.but-order-submit').on('click',function(){
        // $('#Order_street').parents('.form-group').removeClass('has-error');
        $('.emty-adres').remove();
        if($('#delivery-2').is(':checked') && $('#Order_street').val() == ''){
            $('#Order_street').parents('.form-group').addClass('has-error').removeClass('has-success')
            $('#Order_street').parents('.form-group').append('<div class=\"help-block error emty-adres\">Необходимо заполнить поле \"Адрес доставки\"</div>');
            return false;
            }else{
                $('#Order_street').parents('.form-group').removeClass('has-error');
                $('.emty-adres').remove();
                return true;
            }
        })
        $('#check-agreement').on('change',function(){
            if(!$(this).is(':checked')){
                $('.but-order-submit').css({
                    'opacity':'.5',
                    'pointer-events':'none'
                    })
                }else{
                    $('.but-order-submit').removeAttr('style');
                }
            })
"); ?>