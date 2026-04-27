<?php
/**
 * Файл настроек для модуля offer
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.offer.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.offer.OfferModule',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/offer' => 'offer/offer/index',
    ],
];