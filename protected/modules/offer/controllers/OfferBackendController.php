<?php
/**
* OfferBackendController контроллер для offer в панели управления
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2020 amyLabs && Yupe! team
* @package yupe.modules.offer.controllers
* @since 0.1
*
*/

class OfferBackendController extends \yupe\components\controllers\BackController
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