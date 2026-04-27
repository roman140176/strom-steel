<?php
require_once __DIR__ . '/Roistat.php';

/**
 * Задать вопрос по товару
 * @param $data
 * @return array
 */
function CallbackEmailModal($data)
{
    $comment  = "Название продуката: {$data['prodName']}\r\n";
    $comment .= "Комменатрий: {$data['body']}";
    return [
        Roistat::NAME     => $data['name'],
        Roistat::PHONE    => $data['phone'],
        Roistat::COMMENT  => $comment,
        Roistat::FORMNAME => 'Задать вопрос по товару',
    ];
}

/**
 * Заказать звонок
 * @param $data
 * @return array
 */
function CallbackFormModal($data)
{
    return [
        Roistat::NAME     => $data['name'],
        Roistat::PHONE    => $data['phone'],
        Roistat::FORMNAME => 'Заказать звонок',
    ];
}

/**
 * Обратная связь
 * @param $data
 * @return array
 */
function CallbackFormEmailModal($data)
{
    return [
        Roistat::NAME     => $data['name'],
        Roistat::PHONE    => $data['phone'],
        Roistat::FORMNAME => 'Обратная связь',
    ];
}

/**
 * @param string $type
 * @param $id
 * @return string|null
 */
function deliveryAndPaySwitch($type = 'delivery_id', $id)
{
    $data = [
        'payment_method_id' => [
            1 => 'Оплата на расчетный счет организации',
            2 => 'Оплата наличным',
        ],
        'delivery_id' => [
            1 => 'Самовывоз со склада',
            2 => 'Доставка автотранспортом поставщика',
        ]
    ];
    return !empty($data[$type][$id]) ? $data[$type][$id] : null;
}

/**
 * Корзина
 * @param $data
 * @return array|false
 */
function Order($data)
{
    if(!is_array($data)) return false;
    $comment = '';
    if($data['products']) {
        foreach ($data['products'] as $productItem) {
            $product = $productItem->product;
            $qty = !empty($_REQUEST['OrderProduct']["product_{$product->getId()}_"]['quantity'])
                    ? $_REQUEST['OrderProduct']["product_{$product->getId()}_"]['quantity']
                    : 1;
            $comment .= "{$product->getName()}, кол-во: {$qty}, цена: {$product->getPrice()}руб.\r\n";
        }
    }

    $userData = $_REQUEST['Order'];

    $delivery = deliveryAndPaySwitch('delivery_id', $userData['delivery_id']);
    $payment  = deliveryAndPaySwitch('payment_method_id', $userData['payment_method_id']);

    if($delivery) {
        $comment .= "Способ доставки: {$delivery}\r\n";
    }
    if($payment) {
        $comment .= "Выберите способ оплаты: {$payment}\r\n";
    }
    if($userData['street']){
        $comment .= "Адрес доставки: {$userData['street']}\r\n";
    }

    $comment .= "\r\nКомментарий к заказу: \r\n{$userData['comment']}";
    return [
        Roistat::NAME     => $userData['name'],
        Roistat::EMAIL    => $userData['email'],
        Roistat::PHONE    => $userData['phone'],
        Roistat::COMMENT  => $comment,
        Roistat::FORMNAME => 'Заказ из корзины',
        Roistat::FIELDS   => [
            'price' => $data['price'],
        ]
    ];
}

/**
 * @param $action
 * @param $data
 * @return bool|string
 */
function sendDataToRoistat($action, $data)
{
    if(!function_exists($action))  return false;
    Roistat::writeToLog($action($data), $action);
    
    return Roistat::createLead($action, $action($data));
}

/**
 * @param $str
 */
function rdump($str)
{
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
}