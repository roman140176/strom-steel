<?php $active = $count > 0 ? 'active' : '' ; ?>

<div class="header-comparison">
        <a class="but-circle-comparison__icon but-header__icon" href="<?= Yii::app()->createUrl('/store/offers/view') ?>">
            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/product-favorite.svg'); ?>
            <div class="header-comparison__count but-circle-comparison__count <?= $active ?>">
                    <?= $count > 0 ? $count : ''; ?>
            </div>
        </a>

</div>