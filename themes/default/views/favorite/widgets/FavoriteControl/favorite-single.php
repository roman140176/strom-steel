<?php if(false === $favorite->has($product->id)):?>
    <div class="product-vertical-extra__button yupe-store-favorite-add" data-id="<?= $product->id;?>">
        <?php include('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite.svg'); ?>

    </div>
<?php else:?>
    <div class="product-vertical-extra__button yupe-store-favorite-remove text-error" data-id="<?= $product->id;?>">
        <?php include('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite_active.svg'); ?>
    </div>
<?php endif;?>