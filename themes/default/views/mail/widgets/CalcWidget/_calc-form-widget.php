<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
        'id'=>'calc-form-form',
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
    ]); ?>
        <div class="input_wrap">
            <?= $form->textFieldGroup($model, 'area'); ?>

            <?= $form->dropDownListGroup($model, 'angles', [
                'widgetOptions'=>[
                    'data' => $model->getAnglesList(),
                ]
            ]); ?>

            <?= $form->dropDownListGroup($model, 'lamp', [
                'widgetOptions'=>[
                    'data' => $model->getLampList(),
                ]
            ]); ?>

            <?= $form->dropDownListGroup($model, 'pipe', [
                'widgetOptions'=>[
                    'data' => $model->getPipeList(),
                ]
            ]); ?>

            <?= $form->dropDownListGroup($model, 'gardina', [
                'widgetOptions'=>[
                    'data' => $model->getGardinaList(),
                ]
            ]); ?>

            <?= $form->dropDownListGroup($model, 'chandelier', [
                'widgetOptions'=>[
                    'data' => $model->getChandelierList(),
                ]
            ]); ?>
     </div>
     <div class="phone_wrap">
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
    </div>
        <?= $form->hiddenField($model, 'code'); ?>


            <div class="form-button">
                <button type="submit" data-send="ajax" id="calc-form-button" class="banner_calc">Отправить</button>
            </div>


        <?php if (Yii::app()->user->hasFlash('calc-form-success')): ?>
     <script>
        $('#messegeCalcModal').modal('show');
        setTimeout(function(){
            $('#messegeCalcModal').modal('hide');
        }, 500000);
    </script>
<?php endif ?>

<?php $this->endWidget(); ?>
