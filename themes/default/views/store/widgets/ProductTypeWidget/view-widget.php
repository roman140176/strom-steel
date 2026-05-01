<?php if($models) : ?>
    <div class="container d-flex">
        <h2 class="page_title no-padding">Распродажа</h2>
            <div class="arrow-container"></div>
    </div>
    <div class="product-box">
        <?php foreach ($models as $key => $data) : ?>
            <div class="product-box__item__wrap">
               <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

