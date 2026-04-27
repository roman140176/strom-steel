<?php $filter = Yii::app()->getComponent('attributesFilterModify'); ?>

<?php $attributeName = $filter->getAttributeName($attribute); ?>
<div class="filter-attributes__item">
    <div class="filter-attributes__name"><?= $attribute->title ?></div>
    <div class="range filter-block">
        <?= CHtml::textField($attributeName.'[from]', $filter->getData($attribute, 'from'), ['placeholder' => 'От']) ?>
        <?= CHtml::textField($attributeName.'[to]', $filter->getData($attribute, 'to'), ['placeholder' => 'До']) ?>
    </div>
</div>