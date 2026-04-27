<?php if(!empty($producers)):?>
    <div class="filter-block filter-div">
        <div class="filter-block__header">
           <span class="cat-name">Страна Бренда</span>
        </div>
        <div class="filter-block__body">
            <div class="filter-block__content">
                <?= CHtml::checkBoxList('countryBrand', !empty($_GET['countryBrand']) ? $_GET['countryBrand'] : [], Producer::model()->getCityList()); ?>
            </div>
        </div>
    </div>
<?php endif;?>
