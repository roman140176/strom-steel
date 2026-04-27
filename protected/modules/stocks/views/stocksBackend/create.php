<?php
/**
 * Отображение для create:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('StocksModule.stocks', 'Stocks') => ['/stocks/stocksBackend/index'],
    'Создание Акции',
];

$this->pageTitle = Yii::t('stocksModule.stocks', 'Add stock');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StocksModule.stocks', 'Control stocks'), 'url' => ['/stocks/stocksBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('stocksModule.stocks', 'Add stock'), 'url' => ['/stocks/stocksBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('stocksModule.stocks', 'Stocks'); ?>
        <small>Создание Акции</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model, 'languages' => $languages]); ?>