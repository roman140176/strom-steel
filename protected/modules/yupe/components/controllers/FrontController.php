<?php
/**
 * Базовый класс для всех контроллеров публичной части
 *
 * @category YupeComponents
 * @package  yupe.modules.yupe.components.controllers
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @version  0.6
 * @link     https://yupe.ru
 **/

namespace yupe\components\controllers;

use Yii;
use yupe\events\YupeControllerInitEvent;
use yupe\events\YupeEvents;
use application\components\Controller;

/**
 * Class FrontController
 * @package yupe\components\controllers
 */
abstract class FrontController extends Controller
{
    public $mainAssets;
    public $main_page = false;
    public $storeItem = '_item';
    public $storeCountPage = 12;

    /**
     * Вызывается при инициализации FrontController
     * Присваивает значения, необходимым переменным
     */
    public function init()
    {
        Yii::app()->eventManager->fire(YupeEvents::BEFORE_FRONT_CONTROLLER_INIT, new YupeControllerInitEvent($this, Yii::app()->getUser()));

        parent::init();

        Yii::app()->theme = $this->yupe->theme ?: 'default';

        $this->mainAssets = Yii::app()->getTheme()->getAssetsUrl();

        $bootstrap = Yii::app()->getTheme()->getBasePath() . DIRECTORY_SEPARATOR . "bootstrap.php";

        if (is_file($bootstrap)) {
            require $bootstrap;
        }
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'InlineWidgetsBehavior' => [
                'class' => 'yupe.components.behaviors.InlineWidgetsBehavior',
                'startBlock' => '==[[w:',
                'endBlock' => ']]==',
                'widgets' => Yii::app()->params['runtimeWidgets'],
            ],
        ];
    }
     public function beforeAction($action)
    {
        if(isset($_COOKIE["store_item"])) {
            $this->storeItem = $_COOKIE["store_item"];
        }
         if(isset($_COOKIE["store_count"])) {
            $this->storeCountPage = $_COOKIE["store_count"];
        }

        return parent::beforeAction($action);
    }
}
