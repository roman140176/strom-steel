<?php $filter = Yii::app()->getComponent('attributesFilterModify'); ?>

<?php $attributeName = $filter->getAttributeName($attribute); ?>
<div class="filter-attributes__item">
	<div class="filter-attributes__name"><?= $attribute->title ?></div>
	<div class="drop-down-check-box-list filter-block wrapper-dropdown-ul">
		<div class="filter-block__title"></div>
		<div class="filter-block__body">
	        <div class="filter-block__list">
			    <?= CHtml::checkBoxList($attributeName, $filter->getData($attribute), $filter->getOptionList($attribute), [
			    	'template' => "<div class='checkbox'>{input}{label}</div>",
			    	'separator' => '',
					'container' => 'div'
			    ]) ?>
			</div>
	    </div>
	</div>
</div>