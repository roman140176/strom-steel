<?php $filter = Yii::app()->getComponent('attributesFilterModify'); ?>
<?php $attributeName = $filter->getAttributeName($attribute); ?>
<div class="filter-block filter-attributes__item">
    <div class="filter-attributes__name"><?= $attribute->title ?></div>
        <div class="filter-block__body">

                <?= CHtml::checkBoxList($attributeName, $filter->getData($attribute), $filter->getOptionList($attribute, $category), [
                    'template' => "<div class='checkbox'>{input}{label}</div>",
                    'separator' => '',
                    'container' => 'div'
                ]) ?>

        </div>
</div>