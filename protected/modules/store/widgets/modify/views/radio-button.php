<?php $filter = Yii::app()->getComponent('attributesFilterModify'); ?>

<?php $attributeName = $filter->getAttributeName($attribute); ?>
<div class="filter-attributes__item">
	<div class="filter-attributes__name"><?= $attribute->title ?></div>
	<div class="radio-button filter-block wrapper-dropdown-ul">
		<div class="filter-block__title"></div>
		<div class="filter-block__body">
	        <div class="filter-block__list">
			    <?= CHtml::radioButtonList($attributeName, $filter->getData($attribute), $filter->getOptionList($attribute), [
			    	'template' => "<div class='radiobutton'>{input}{label}</div>",
			    	'separator' => '',
					'container' => 'div'
			    ]) ?>
			</div>
	    </div>
	</div>
</div>