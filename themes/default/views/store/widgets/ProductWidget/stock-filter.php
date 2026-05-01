  <div class="filter-block filter-div">
        <div class="filter-block__header">
           <span class="cat-name">На складе</span>
        </div>
        <div class="filter-block__body">
            <div class="filter-block__content">
                <?= CHtml::checkBoxList('stock', !empty($_GET['stock']) ? $_GET['stock'] : [], Product::model()->getInStockList()); ?>
            </div>
        </div>
    </div>
