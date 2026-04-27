<?php if($products) : ?>
	<div class="product-box product-big-box product-big-box-carousel">
	    <?php foreach ($products as $key => $data) : ?>
	    	<div>
            	<?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
            </div>
	    <?php endforeach; ?>
    </div>
<?php endif; ?>
