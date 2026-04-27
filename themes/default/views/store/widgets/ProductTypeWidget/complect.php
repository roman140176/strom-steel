<?php if($models) : ?>
    <div class="comlects_box">
        <?php foreach ($models as $key => $data) : ?>
            <div class="comlects_box__item__wrap">
              <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

