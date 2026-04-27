<?php if(!empty($categories)):?>

            <?php foreach($categories as $categori):?>
                   <?php foreach ($categori->children as $category): ?>
                        <div class="filter-block__item filter-checkbox filter-list">
                    <?= CHtml::checkBox('category[]',Yii::app()->attributesFilter->isMainSearchParamChecked(AttributeFilter::MAIN_SEARCH_PARAM_CATEGORY, $category->id, Yii::app()->getRequest()),['value' => $category->id, 'id' => 'category_'. $category->id]);?>
                    <?= CHtml::label($category->name, 'category_'. $category->id);?>
                </div>
                   <?php endforeach ?>
            <?php endforeach;?>

<?php endif;?>


