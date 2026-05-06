<div class="modal fade" id="customfield-groups" tabindex="-1" role="dialog" aria-labelledby="customfield-groups-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="customfield-groups-label"><?= Yii::t("YupeModule.yupe", "Группы произвольных полей"); ?></h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget(
                    '\yupe\widgets\ActiveForm',
                    [
                        'id' => 'customfield-group-form',
                        'action' => Yii::app()->createUrl('/yupe/customfieldBackend/create'),
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => true,
                        'type' => 'vertical',
                        'clientOptions' => [
                            'validateOnSubmit' => true,
                            'afterValidate' => 'js:groupsSendForm'
                        ],
                    ]
                ); ?>
                <div class="row">
                    <div class="col-xs-9">
                        <?= $form->textFieldGroup($customfieldGroup, 'name', [
                            'labelOptions' => ['class' => 'hidden']
                        ]); ?>
                    </div>
                    <div class="col-xs-3">
                        <button type="submit" class="btn btn-success">
                            <?= Yii::t("YupeModule.yupe", "Добавить"); ?>
                        </button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
                <div class="row">
                    <div class="col-xs-12">
                        <?php $this->renderPartial('groups_grid', ['customfieldGroup' => $customfieldGroup]) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <?= Yii::t("YupeModule.yupe", "Закрыть"); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function groupsSendForm(form, data, hasError) {
        if (hasError) return false;

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function (response) {
                if (response.result) {
                    document.getElementById("customfield-group-form").reset();
                    $.fn.yiiGridView.update('group-grid');
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function updateGroupDropdown(){
        $.ajax({
            url: '<?= Yii::app()->createUrl('/yupe/customfieldBackend/data'); ?>',
            success: function (response) {
                if (!response.result) {
                    return false;
                }

                var options = '<option><?= Yii::t('YupeModule.yupe', '--choose--') ?></option>';

                $.each(response.data, function (i, item) {
                    options += '<option value="' + i + '">' + item + '</option>';
                });

                $('.customfield-group-dropdown').each(function(){
                    var selected = $(this).val();

                    $(this).html(options);

                    if (selected && $(this).find('option[value="' + selected + '"]').val() !== undefined) {
                        $(this).val(selected);
                    }
                });
            }
        });
    }
</script>