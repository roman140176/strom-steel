<?php $filter = Yii::app()->getComponent('attributesFilterModify'); ?>

<?php $attributeName = $filter->getAttributeName($attribute); ?>
<div class="filter-attributes__item">
	<div class="check-box">
		<div class="checkbox">
		    <?= CHtml::checkBox($attributeName, $filter->getData($attribute)) ?>
		    <label for="<?= $attributeName ?>"><?= $attribute->title ?></label>
		</div>
	</div>
</div>