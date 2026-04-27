<?php if(false === $favorite->has($product->id)):?>
    <div class="but but-border product-favorite__button yupe-product-favorite-add" data-id="<?= $product->id;?>">
        <?php include('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite.svg'); ?>
    </div>
<?php else:?>
    <div class="but but-border product-favorite__button yupe-product-favorite-remove text-error" data-id="<?= $product->id;?>">
        <?php include('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite_active.svg'); ?>

    </div>
<?php endif;?>