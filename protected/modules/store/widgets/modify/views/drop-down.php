<?php $filter = Yii::app()->getComponent('attributesFilterModify'); ?>

<?php $attributeName = $filter->getAttributeName($attribute); ?>
<div class="filter-attributes__item">
	<div class="filter-attributes__name"><?= $attribute->title ?></div>
	<div class="drop-down filter-block">
	    <?= CHtml::dropDownList($attributeName, $filter->getData($attribute), $filter->getOptionList($attribute), ['empty' => '']) ?>
	</div>
</div>

<?php Yii::app()->getClientScript()->registerScript(
    "drop-down",
    <<<JS
        $('select').styler({ selectSearch: true });
JS
); ?>