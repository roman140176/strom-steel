<?php $class = isset($items[$this->id]) ? 'active' : '' ; ?>

<a data-no-swup href="<?= Yii::app()->createUrl('/store/offers/index', ['id' => $this->id]) ?>" class="product-compare offers-button <?= $class; ?>">
    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/product-favorite.svg'); ?>
</a>