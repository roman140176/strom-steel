<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="filter-block">
    <div class="filter-block__header">
        <span data-title="<?= $attribute->title ?>" data-unit="<?= $attribute->unit; ?>"><?= $attribute->title ?><?= ($attribute->unit) ? ', '.$attribute->unit : ''; ?></span>

    </div>
    <div class="filter-block__body">
        <div class="filter-block__content">
            <div class="filter-block-range range-input" id="range-input-<?= $attribute->id; ?>" type="range-input">
                <?= CHtml::numberField($filter->getFieldName($attribute, 'from'), $filter->getFieldValue($attribute, 'from'), [
                    'class' => "form-control js-from-{$attribute->id} filter-block-range__item",
                    'placeholder' => Yii::t('StoreModule.store', 'from')
                ]); ?>
                <?= CHtml::numberField($filter->getFieldName($attribute, 'to'), $filter->getFieldValue($attribute, 'to'), [
                    'class' => "form-control js-to-{$attribute->id} filter-block-range__item",
                    'placeholder' => Yii::t('StoreModule.store', 'to')
                ]); ?>
            </div>
            <div class="range">
                <input type="text" class="js-range" id="js-range-<?= $attribute->id; ?>" name="my_range_<?= $attribute->id; ?>" value=""
                    data-type="double"
                    data-min="0"
                    data-max="100"
                    data-from="0"
                    data-to="100"
                    data-grid="true"
                    data-skin="round"
                />
            </div>
        </div>
        <div class="filter-block__but filter-block__but_noafter">
            <input type="submit" value="Применить" class="but but-filter"/>
        </div>
    </div>
</div>

<?php Yii::app()->getClientScript()->registerScript("js-range-{$attribute->id}", "
    var \$range{$attribute->id} = $('#js-range-{$attribute->id}'),
        \$from{$attribute->id} = $('.js-from-{$attribute->id}'),
        \$to{$attribute->id} = $('.js-to-{$attribute->id}'),
        my_range_{$attribute->id},
        min{$attribute->id} = $('#js-range-{$attribute->id}').data('min'),
        max{$attribute->id} = $('#js-range-{$attribute->id}').data('max'),
        from{$attribute->id},
        to{$attribute->id};

    var updateValues{$attribute->id} = function () {
        \$from{$attribute->id}.prop('value', from{$attribute->id});
        \$to{$attribute->id}.prop('value', to{$attribute->id});
    };

    \$range{$attribute->id}.ionRangeSlider({
        onStart: function (data) {
            from{$attribute->id} = data.from;
            to{$attribute->id} = data.to;

            // updateValues{$attribute->id}();
        },
        onChange: function (data) {
            from{$attribute->id} = data.from;
            to{$attribute->id} = data.to;

            updateValues{$attribute->id}();
        },
        onFinish: function (data) {
            from{$attribute->id} = data.from;
            to{$attribute->id} = data.to;

            updateValues{$attribute->id}();
        }
    });

    my_range_{$attribute->id} = \$range{$attribute->id}.data('ionRangeSlider');

    var updateRange{$attribute->id} = function () {
        my_range_{$attribute->id}.update({
            from: from{$attribute->id},
            to: to{$attribute->id}
        });
    };
    \$from{$attribute->id}.focusout(function (event) {
    // $(document).delegate(\$from{$attribute->id}, 'keyup', function(e){
        from{$attribute->id} = +$(this).prop('value');
        if (from{$attribute->id} < min{$attribute->id}) {
            from{$attribute->id} = min{$attribute->id};
        }
        if (from{$attribute->id} > to{$attribute->id}) {
            from{$attribute->id} = to{$attribute->id};
        }

        updateValues{$attribute->id}();
        updateRange{$attribute->id}();
    });
    \$to{$attribute->id}.focusout(function (event) {
    // $(document).delegate(\$to{$attribute->id}, 'keyup', function(e){
        to{$attribute->id} = +$(this).prop('value');
        if (to{$attribute->id} > max{$attribute->id}) {
            to{$attribute->id} = max{$attribute->id};
        }
        if (to{$attribute->id} < from{$attribute->id}) {
            to{$attribute->id} = from{$attribute->id};
        }

        updateValues{$attribute->id}();
        updateRange{$attribute->id}();
    });
"); ?>