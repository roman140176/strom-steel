<?php $filter = Yii::app()->getComponent('attributesFilterModify'); ?>

<?php $attributeName = $filter->getAttributeName($attribute); ?>
<div class="filter-attributes__item">
	<div class="filter-attributes__name"><?= $attribute->title ?></div>
	<div class="single-input filter-block">
	    <?= CHtml::textField($attributeName, $filter->getData($attribute), ['placeholder' => $attribute->title]) ?>
	</div>
</div>