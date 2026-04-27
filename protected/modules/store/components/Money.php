<?php

/**
 * Class Money - заглушка для конвертора валют
 */
class Money extends CApplicationComponent
{
    /**
     * @param $sum
     * @param $currency
     * @return mixed
     */
    public function convert($sum, $currency)
    {
        $json = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
        $currencyValue = json_decode($json, true)['Valute'][$currency]['Value'];
        return round($sum * $currencyValue);
    }
}