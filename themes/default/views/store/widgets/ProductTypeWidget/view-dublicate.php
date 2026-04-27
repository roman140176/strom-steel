<?php if($models) : ?>
    <div class="product-box product-box-carousel">
        <?php foreach ($models as $key => $data) : ?>


                    <div class="product-box__item__wrap">
                    <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
                    </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>

