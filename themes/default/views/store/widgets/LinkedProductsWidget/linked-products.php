<?php /* @var $dataProvider CActiveDataProvider */ ?>
<?php if ($dataProvider->getTotalItemCount()): ?>
    <div class="product-linked">
        <div class="content">
            <div class="box-style">
                <div class="box-style__header">
                   <div class="box-style__heading">
                        Похожие товары
                    </div>
                    <div class="box-style__desc">
                        Рекомендуем ознакомиться
                    </div>
                </div>
                <div class="box-style__content">
                    <div class="product-box product-box-carousel">
                        <?php foreach ($dataProvider->getData() as $key => $data) : ?>
                            <div>
                                <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>