<?php if($products) : ?>
	<div class="box-style">
        <div class="box-style__header">
            <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
                'id' => 13
            ]); ?>
        </div>
        <div class="box-style__content">
			<div class="product-box product-box-carousel">
			    <?php foreach ($products as $key => $data) : ?>
			    	<div>
		            	<?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
			    	</div>
			    <?php endforeach; ?>
		    </div>
		</div>
	</div>
<?php endif; ?>
