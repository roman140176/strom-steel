<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
        'id'=>'calc-form',
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'calc-form', 'data-type' => 'ajax-form', 'enctype' => 'multipart/form-data'],
    ]); ?>

        <div class="inputs">
            <div class="names">
            <?= $form->textFieldGroup($model, 'name'); ?>
            <div class="form-group">
                <?= $form->labelEx($model, 'phone', ['class' => 'control-label']) ?>
                <?php $this->widget('CMaskedTextFieldPhone', [
                    'model' => $model,
                    'attribute' => 'phone',
                    'mask' => '+7(999)999-99-99',
                    'htmlOptions'=>[
                        'class' => 'data-mask form-control',
                        'data-mask' => 'phone',
                        'placeholder' => 'Телефон',
                        'autocomplete' => 'off'
                    ]
                ]) ?>
            </div>
                <?= $form->textFieldGroup($model, 'email'); ?>

            </div><!--names-->
                <div class="radios">
                    <div class="radios_wrap">
                        <?= $form->radioButtonListGroup($model, 'material', [
                        'widgetOptions'=>[
                            'data' => $model->getMaterialList(),
                        ]
                    ]); ?>
                  </div>
                </div>

            <div class="getKviewList_box">
                <div class="getKviewList_box-item">
                    <?= $form->radioButtonListGroup($model, 'kview', [
                        'widgetOptions'=>[
                            'data' => $model->getKviewList(),
                        ]
                    ]); ?>
                </div>
                <div class="imagebg js-imagebg"></div>
                <div class="getKviewList_box-inputs">
                    <?= $form->textFieldGroup($model, 'kviewP',[
                        'widgetOptions'=>[
                        'htmlOptions'=>[
                            'class' => '',
                            'placeholder' => 'СМ',
                            'autocomplete' => 'off',
                        ]
                    ]
                ]) ?>
                    <?= $form->textFieldGroup($model, 'kviewL',[
                      'widgetOptions'=>[
                        'htmlOptions'=>[
                            'class' => '',
                            'placeholder' => 'СМ',
                            'autocomplete' => 'off',
                        ]
                    ]
                ]) ?>
                    <?= $form->textFieldGroup($model, 'kviewR',[
                      'widgetOptions'=>[
                        'htmlOptions'=>[
                            'class' => '',
                            'placeholder' => 'СМ',
                            'autocomplete' => 'off',
                        ]
                    ]
                ]) ?>
                </div>
            </div>
            <div class="heght_stoleshnic">
                <div class="checkboxes">
                     <?= $form->checkboxListGroup($model, 'stoleshnic', [
                            'widgetOptions'=>[
                                'data' => $model->getStolicList(),
                            ]
                        ]); ?>
                </div>
                <div class="heght_box">
                      <?= $form->dropDownListGroup($model, 'height', [
                                'widgetOptions' => [
                                    'data' => $model->getHeightList(),
                                ]
                            ]) ?>
                </div>
            </div>
            <div class="body_box">
                <?= $form->textAreaGroup($model, 'txt') ?>
            </div>
     </div>
                <div class="file-upload">
                        <label class="vision">
                            <?= $form->fileField($model, 'image'); ?>
                            <?= $form->error($model, 'image'); ?>

                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                <div id="count_file">
                                    Отправьте нам чертеж кухни<br> если он у вас есть
                                </div>

                        </label>
                </div>

        <?= $form->hiddenField($model, 'code'); ?>


            <div class="form-button">
                <button type="submit" data-send="ajax" id="calc-form-button" class="blue">Расчитать стоимость</button>
            </div>



        <?php if (Yii::app()->user->hasFlash('calc-form-success')): ?>
        <div id="messegeCalcModal" class="modal fade in" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                    aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Уведомление!</h4>
            </div>
            <div class="modal-body">
                <?= Yii::app()->user->getFlash('success') ?>
            </div>
        </div>
    </div>
    </div>
     <script>
        $('#messegeCalcModal').modal('show');
        setTimeout(function(){
            $('#messegeCalcModal').modal('hide');
        }, 500000);
    </script>
<?php endif ?>

<?php $this->endWidget(); ?>

<?php
$json = CJSON::encode([
    'CalcFormModel_kview_0' => [
        'CalcFormModel_kviewP' => 'show',
        'CalcFormModel_kviewR' => 'show',
        'CalcFormModel_kviewL' => 'show',
    ],
    'CalcFormModel_kview_1' => [
        'CalcFormModel_kviewP' => 'show',
        'CalcFormModel_kviewR' => 'hide',
        'CalcFormModel_kviewL' => 'show',
    ],
    'CalcFormModel_kview_2' => [
        'CalcFormModel_kviewP' => 'show',
        'CalcFormModel_kviewR' => 'show',
        'CalcFormModel_kviewL' => 'hide',
    ],
    'CalcFormModel_kview_3' => [
        'CalcFormModel_kviewP' => 'show',
        'CalcFormModel_kviewR' => 'hide',
        'CalcFormModel_kviewL' => 'hide',
    ]
]);
Yii::app()->clientScript->registerScript("name", "
    var data = JSON.parse('{$json}');
    $('#CalcFormModel_kview').on('change', function() {
        var checked = $(this).find('input:checked');
        var id = checked.attr('id');
        var info = data[id];
        var imageId = id+'-image';
        $('.js-imagebg').attr('id', imageId);
        $.each(info, function(i, e) {
            $('#'+i)
                .parent()
                .removeClass('hide show')
                .addClass(e);
        })
        return false;
    })

");
?>