<?php use yupe\helpers\YText; ?>
<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="filter-block filter-div">
    <div class="filter-block__header">
        <small style="display: block;color:#989898"><?= $attribute->group['name'];?></small>
        <span class="cat-name"><?= $attribute->title ==='панель'? 'Декоративная панель' : $attribute->title?></span>
    </div>
    <div class="filter-block__body">
        <div class="filter-block__content">
            <?php $cat = [] ?>

            <?php foreach ($attribute->getOptionsList($category, true) as $key => $option): ?>
                <?php if (!isset($cat[$option->cat])): ?>
                    <?php $cat[$option->cat] = $option->cat; ?>
                    <?php $id =  'cat-'.YText::translit($option->cat) ?>
                  <div>
                            <input type="checkbox" name="cat[<?= $attribute->id ?>][]" value="<?= $option->cat ?>" id="<?= $id ?>" <?= (isset($_GET['cat'], $_GET['cat'][$attribute->id]) and array_search($option->cat, $_GET['cat'][$attribute->id])!==false) ? 'checked' : '' ?>>

                    <label for="<?= $id ?>"> <?= $option->cat?></label>
                  </div>

                <?php endif ?>
            <?php endforeach; ?>
            <hr>
            <?php foreach ($attribute->getOptionsList($category) as $option): ?>
                <div class="filter-block__item filter-checkbox filter-list">
                    <?= CHtml::checkBox($filter->getDropdownOptionName($option), $filter->getIsDropdownOptionChecked($option, $option->id), [
                        'value' => $option->id,
                        'id' => $attribute->name."_".$option->id,
                        'data-cat' => $option->cat,
                        'class' => 'panel-input active-input'
                    ]) ?>

                    <?= CHtml::label($option->value, $attribute->name."_".$option->id);?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
