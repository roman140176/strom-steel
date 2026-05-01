<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="filter-block filter-div">
    <div class="filter-block__header">
        <small style="display: block;color:#989898"><?= $attribute->group['name'];?></small>
        <span class="cat-name"><?= $attribute->title ==='панель'? 'Декоративная панель' : $attribute->title?></span>
    </div>
    <div class="filter-block__body">
        <div class="filter-block__content">
            <?php
                $cat = [];
             ?>
            <?php foreach ($attribute->getOptionsList($category) as $option): ?>
                <div class="filter-block__item filter-checkbox filter-list">
                    <?= CHtml::checkBox($filter->getDropdownOptionName($option), $filter->getIsDropdownOptionChecked($option, $option->id), [
                        'value' => $option->id,
                        'id' => $attribute->name."_".$option->id
                    ]) ?>

                    <?= CHtml::label($option->value, $attribute->name."_".$option->id);?>
                    <?php
                        array_push($cat, $option->cat);
                        $cat = array_unique($cat);
                     ?>
                </div>
            <?php endforeach; ?>
                <?php foreach ($cat as $value): ?>
                    <?= CHtml::checkBox($filter->getDropdownOptionName($option), $filter->getIsDropdownOptionChecked($option, $option->id), [
                        'value' => $option->id,
                        'id' => $attribute->name."_".$option->id
                    ]) ?>
                     <?= CHtml::label($value, $attribute->name."_".$option->id);?>
                <?php endforeach ?>
        </div>

    </div>
</div>
