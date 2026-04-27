<?php
$currency = Yii::t('StoreModule.store', Yii::app()->getModule('store')->currency);
?>
<html>
<head>

</head>
<body>
<h1 style="font-weight:normal;">
    Ваш заказ на сумму <?= $order->getTotalPriceWithDelivery();?> <?= $currency ?> в магазине "<?= Yii::app()->getModule('yupe')->siteName;?>".
</h1>

<table cellpadding="6" cellspacing="0" style="border-collapse: collapse; line-height: 1.2">

    <?php foreach ($order->products as $orderProduct): ?>
        <?php $productUrl = ProductHelper::getUrl($orderProduct->product, true) ?>
        <tr>
            <td align="center"
                style="padding:6px; width:100px; padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?php if ($orderProduct->product): ?>
                    <a href="<?= $productUrl; ?>">
                        <?php if ($orderProduct->product->image): ?>
                            <img border="0" src="<?= $orderProduct->product->getImageUrl(
                                50,
                                50
                            ); ?>">
                        <?php endif; ?>
                    </a>
                <?php else: ?>
                    <?= CHtml::encode($orderProduct->product_name); ?>
                <?php endif; ?>
            </td>
            <td style="padding:6px; width:250px; padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;">
                <a href="<?= $productUrl; ?>"><?= $orderProduct->product_name; ?></a>
                <?php foreach ($orderProduct->variantsArray as $variant): ?>
                    <h5><?= $variant['attribute_title']; ?>: <?= $variant['optionValue']; ?></h5>
                <?php endforeach; ?>
            </td>
            <td align=right
                style="padding:6px; text-align:right; width:150px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?= $orderProduct->quantity; ?> шт. &times; <?= $orderProduct->price; ?>&nbsp; <?= $currency ?>
            </td>
        </tr>
    <?php endforeach; ?>


    <?php if ($order->hasCoupons()): ?>
        <tr>
            <td style="padding:6px; width:100px; padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;"></td>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;">
                Купон <?= CHtml::encode(implode(', ', $order->getCouponsCodes())); ?>
            </td>
            <td align=right
                style="padding:6px; text-align:right; width:170px; background-color:#ffffff; border:1px solid #e0e0e0;">
                &minus;<?= $order->coupon_discount; ?>&nbsp;<?= $currency ?>
            </td>
        </tr>
    <?php endif; ?>

    <?php if ($order->delivery && !$order->separate_delivery): ?>
        <tr>
            <td style="padding:6px; width:100px; padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                Способ доставки
            </td>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;">
                <?= CHtml::encode($order->delivery->name); ?>
            </td>
            <td align="right"
                style="padding:6px; text-align:right; width:170px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?php if ($order->delivery->id == 2): ?>
                    Оплата индивидуально
                    <?php else: ?>
                <?= $order->getDeliveryPrice(); ?>&nbsp;<?= $currency ?>
                <?php endif ?>

            </td>
        </tr>
    <?php endif; ?>
    <tr>
        <td style="padding:6px; background-color:#fff; border:1px solid #e0e0e0;">
            Способ оплаты
        </td>
        <td colspan="2" style="padding:6px; background-color:#fff; border:1px solid #e0e0e0;" align="right">
            <?= $order->payment->name ?>
            <?php if ($order->payment_method_id == 2): ?>
                <div class="payment__description__res" style="margin-top:5px; font-size: 80%">
                    Прием платежей в офисе ООО «СТРОМ ТРЕЙД» по адресу:<br>
                    Москва, ул. Киевская д. 19, 2 этаж, ком. 34
                </div>
            <?php endif ?>
        </td>
    </tr>

    <tr>

        <td style="padding:6px; background-color:#fff; border:1px solid #e0e0e0;font-weight:bold;" colspan="2">
            Итого
        </td>
        <td align="right"
            style="padding:6px; text-align:right; width:170px; background-color:#fff; border:1px solid #e0e0e0;font-weight:bold;">
            <?= $order->getTotalPriceWithDelivery(); ?>&nbsp;<?= $currency ?>
        </td>
    </tr>
</table>

<br/>
Вы всегда можете проверить состояние заказа по ссылке:<br>
<?= CHtml::link(
    Yii::app()->createAbsoluteUrl('/order/order/view', ['url' => $order->url]),
    Yii::app()->createAbsoluteUrl('/order/order/view', ['url' => $order->url])
); ?>
<br/>
<div class="warn" style="margin-top:10px">
    Вы получили это письмо на свой электронный адрес, так как является покупателем интернет-магазина
"СТРОМ ТРЭЙД" и создали на сайте заказ, изменили профиль или совершили иное действие, которое
требует уведомления по электронной почте. <br>
Если вы не совершали никаких действий на сайте магазина, то рекомендуется изменить пароль
учетной записи - возможно, кто-то получил доступ к вашему аккаунту на сайте <a href="http://stromsteel.ru/">www.stromsteel.ru.</a>
</div>
<h3 style="margin-top:15px;margin-bottom:10px">Мы в соцсетях</h3>
<div class="soc" style="direction: flex;">
    <a href="https://www.facebook.com/stromtradem/" target="_blank" style="text-decoration: none;display: flex;align-items:center;justify-content: center;width:40px;height:40px">
        <img src="http://stromsteel.ru/uploads/image/facebook.png" alt="" style="width:20px;">
    </a>
    <a href="https://vk.com/stromtradem" style="margin-left:10px;margin-right:10px;text-decoration: none;display: flex;align-items:center;justify-content: center;width:40px;height:40px">
        <img src="http://stromsteel.ru/uploads/image/vk.png" alt="" style="width:20px;">

    </a>
    <a href="https://www.instagram.com/strom_trade/" style="text-decoration: none;display: flex;align-items:center;justify-content: center;width:40px;height:40px">
        <img src="http://stromsteel.ru/uploads/image/instagram.png" alt="" style="width:20px;">

    </a>
</div>
</body>
</html>
