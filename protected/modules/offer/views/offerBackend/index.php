<?php
/**
* Отображение для offerBackend/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     https://yupe.ru
**/
$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'offer') => ['/offer/offerBackend/index'],
    Yii::t('OfferModule.offer', 'Index'),
];

$this->pageTitle = Yii::t('OfferModule.offer', 'offer - index');

$this->menu = $this->getModule()->getNavigation();
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('OfferModule.offer', 'offer'); ?>
        <small><?php echo Yii::t('OfferModule.offer', 'Index'); ?></small>
    </h1>
</div>