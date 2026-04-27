<?php
/* @var $model Product - передается при рендере из формы редактирования товара */
/* @var $type Type - передается при генерации формы через ajax */
?>
<?php if (!empty($groups)): ?>
    <div class="row">
        <div class="col-sm-12">
            <?php foreach ($groups as $groupName => $items): ?>
                <fieldset>
                    <legend><?= CHtml::encode($groupName); ?></legend>
                    <?php foreach ($items as $attribute): ?>
                        <?php /* @var $attribute CAttribute */ ?>
                        <?php $hasError = $model->hasErrors($attribute->name); ?>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label for="Attribute_<?= $attribute->name ?>"
                                       class="<?= $hasError ? 'has-error' : null; ?>">
                                    <?= $attribute->title; ?>
                                    <?php if ($attribute->unit): ?>
                                        <span>(<?= $attribute->unit; ?>)</span>
                                    <?php endif; ?>
                                </label>
                            </div>
                            <div
                                class="col-sm-<?= $attribute->isType(CAttribute::TYPE_TEXT) ? 9 : 2; ?> <?= $hasError ? 'has-error' : null; ?>">
                                <?php $htmlOptions = $attribute->isType(CAttribute::TYPE_CHECKBOX) || $attribute->isType(CAttribute::TYPE_CHECKBOX_LIST) ? [] : ['class' => 'form-control']; ?>
                                <?php if ($attribute->isType(CAttribute::TYPE_FILE)): ?>
                                    <?php if ($model->attributeFile($attribute->name)): ?>
                                        <div>
                                            <?= CHtml::link(Yii::t('StoreModule.store', 'Download'),
                                                $model->attributeFile($attribute->name)); ?>
                                            <?= Yii::t('StoreModule.store', 'or'); ?>
                                            <?= CHtml::link(Yii::t('StoreModule.store', 'Delete'), null, [
                                                'class' => 'rm-file-attr',
                                                'data-product' => $model->id,
                                                'data-attribute' => $attribute->id,
                                            ]); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?= AttributeRender::renderField($attribute, $model->attribute($attribute), null,
                                    $htmlOptions); ?>
                            </div>
                            <div class="attr-label">
                                    <script>
                                        $('.row.form-group select').on('change',function(){
                                        $('.attr-label').each(function(){
                                            var prev = $(this).prev().find('option:selected').text();
                                                $(this).html('<span>выбрано:&ensp;</span>' + prev);
                                            })
                                        })
                                        $('.attr-label').each(function(){
                                            var prev = $(this).prev().find('option:selected').text();
                                                $(this).html('<span>выбрано:&ensp;</span>' + prev);
                                            })
                                    </script>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </fieldset>
            <?php endforeach; ?>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.rm-file-attr').on('click', function (event) {
                event.preventDefault();
                var $this = $(this);
                var product = parseInt($(this).data('product'));
                var attribute = parseInt($(this).data('attribute'));
                $.post('<?= Yii::app()->createUrl('/store/attributeBackend/deleteFile');?>', {
                    'product': product,
                    'attribute': attribute,
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                }, function (response) {
                    if (response.result) {
                        $this.parent('div').fadeOut();
                    }
                }, 'json');
            });
        });
    </script>
<?php endif; ?>
<style>
    .col-sm-2 span{
        width: 600px;
        background: #fff;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        -webkit-flex-wrap: wrap;
        -moz-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        -o-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 15px;
        border: 1px solid #757575;
        height: 300px;
        overflow: hidden;
        overflow-y: auto;
    }
    .col-sm-2 span br{
        display: none;
    }
    .col-sm-2 span label{
        margin-right: 15px;
        margin-left: 3px;
        word-break: break-all;
        font-size: 14px;
        width: 90%
    }
    .col-sm-2 span input{
        width: 5%;
    }
</style>