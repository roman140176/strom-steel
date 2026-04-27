<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="filter-block filter-div">
        <div class="atr-name"><?= $attribute->description?>:</div>
    <div class="filter-block__header">
        <span class="cat-name"><small>Выбрать</small></span>
    </div>
    <div class="filter-block__body">
        <div class="filter-block__content">
                <?php foreach ($attribute->getOptionsList($category) as $option): ?>
                    <div class="filter-block__item filter-checkbox filter-list">
                        <?= CHtml::checkBox($filter->getDropdownOptionName($option), $filter->getIsDropdownOptionChecked($option, $option->id), [
                            'value' => $option->id,
                            'id' => $attribute->name."_".$option->id,
                            'data-category'=>$category['parent_id']
                        ]) ?>

                        <?= trim(CHtml::label($option->value, $attribute->name."_".$option->id));?>
                    </div>
                <?php endforeach; ?>
        </div>
         <div class="filter-block__but">
            <input type="submit" value="Применить" class="but but-filter"/>
        </div>
    </div>
</div>
