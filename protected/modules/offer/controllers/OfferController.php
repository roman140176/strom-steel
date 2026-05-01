<?php
/**
* OfferController контроллер для offer на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2020 amyLabs && Yupe! team
* @package yupe.modules.offer.controllers
* @since 0.1
*
*/

class OfferController extends \yupe\components\controllers\FrontController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
        $this->render('index');
    }
}