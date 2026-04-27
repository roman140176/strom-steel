<div class="review-box">
	<div class="review-box__item review-box__item review-box__item_heading">
		<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
		    'id' => 17
		]); ?>
	</div>
	<?php foreach ($model as $key => $data) : ?>
		<?php Yii::app()->controller->renderPartial('//review/review/_item', ['data' => $data]) ?>
	<?php endforeach; ?>
</div>
