<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="price-block filter-div">
    <div class="atr-name" data-title="<?= Yii::t('StoreModule.store', 'Price'); ?>" data-unit="руб."><?= Yii::t('StoreModule.store', 'Price'); ?>:</div>
    <div class="filter-block__header">
        <span class="cat-name" data-title="<?= Yii::t('StoreModule.store', 'Price'); ?>" data-unit="руб."><small>Выбрать</small></span>
    </div>
    <div class="filter-block__body filter-attributes-price">
        <div class="filter-block__content filter-block__item">
            <div class="filter-block-range range-input" id="range-input-price" type="range-input">
                <?= CHtml::numberField('price[from]', Yii::app()->attributesFilter->getMainSearchParamsValue('price', 'from', Yii::app()->getRequest()), [
                    'class' => "form-control js-from-price filter-block-range__item",
                    'placeholder' => Yii::t('StoreModule.store', 'from').' '.ceil($cost['minPrice'])
                ]); ?>
                <?= CHtml::numberField('price[to]', Yii::app()->attributesFilter->getMainSearchParamsValue('price', 'to', Yii::app()->getRequest()), [
                    'class' => "form-control js-to-price filter-block-range__item",
                    'placeholder' => Yii::t('StoreModule.store', 'to').' '.ceil($cost['maxPrice']),
                ]); ?>
            </div>

            <div class="range">
                <input type="text" class="js-range" id="js-range-price" name="my_range_price" value=""
                    data-type="double"
                    data-min= "<?= ($cost['minPrice']) ? ceil($cost['minPrice']) : 0; ?>"
                    data-max="<?= ceil($cost['maxPrice']); ?>"
                    data-from="<?= ($cost['minPrice']) ? ceil($cost['minPrice']) : 0; ?>"
                    data-to="<?= ceil($cost['maxPrice']); ?>"
                    data-grid="true"
                    data-skin="round"
                />
            </div>
        </div>
    <div class="filter-block__but">
        <input type="submit" value="Применить" class="but but-filter"/>
    </div>
    </div>
</div>

<?php Yii::app()->getClientScript()->registerScript("js-range-price", "
    var \$rangePrice = $('#js-range-price'),
        \$fromPrice = $('.js-from-price'),
        \$toPrice = $('.js-to-price'),
        my_range_Price,
        minPrice = $('#js-range-price').data('min'),
        maxPrice = $('#js-range-price').data('max'),
        fromPrice,
        toPrice;

    var updateValuesPrice = function () {
        \$fromPrice.prop('value', fromPrice);
        \$toPrice.prop('value', toPrice);
    };

    \$rangePrice.ionRangeSlider({
        onStart: function (data) {
            fromPrice = data.from;
            toPrice = data.to;

            // updateValuesPrice();
        },
        onChange: function (data) {
            fromPrice = data.from;
            toPrice = data.to;

            updateValuesPrice();
        },
        onFinish: function (data) {
            fromPrice = data.from;
            toPrice = data.to;

            updateValuesPrice();
        }
    });

    my_range_Price = \$rangePrice.data('ionRangeSlider');

    var updateRangePrice = function () {
        my_range_Price.update({
            from: fromPrice,
            to: toPrice
        });
    };
    \$fromPrice.focusout(function (event) {
    // $(document).delegate(\$fromPrice, 'keyup', function(e){
        fromPrice = +$(this).prop('value');
        if (fromPrice < minPrice) {
            fromPrice = minPrice;
        }
        if (fromPrice > toPrice) {
            fromPrice = toPrice;
        }

        updateValuesPrice();
        updateRangePrice();
    });
    \$toPrice.focusout(function (event) {
    // $(document).delegate(\$toPrice, 'keyup', function(e){
        toPrice = +$(this).prop('value');
        if (toPrice > maxPrice) {
            toPrice = maxPrice;
        }
        if (toPrice < fromPrice) {
            toPrice = fromPrice;
        }

        updateValuesPrice();
        updateRangePrice();
    });
"); ?>
