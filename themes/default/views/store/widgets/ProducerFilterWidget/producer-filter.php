<?php if(!empty($producers)):?>
    <div class="filter-block filter-div">
        <div class="filter-block__header">
           <span class="cat-name">Производитель</span>
        </div>
        <div class="filter-block__body">
            <div class="filter-block__content">
            <?php foreach($producers as $producer):?>
                <div class="filter-block__item filter-checkbox filter-list">
                    <?= CHtml::checkBox('brand[]',Yii::app()->attributesFilter->isMainSearchParamChecked(AttributeFilter::MAIN_SEARCH_PARAM_PRODUCER, $producer->id, Yii::app()->getRequest()),['value' => $producer->id, 'id' => 'brand_'.$producer->id]);?>
                    <?= CHtml::label($producer->name, 'brand_'.$producer->id);?>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endif;?>
