<div id="callbackServiceModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Закрыть">
                    <span aria-hidden="true"></span>
                </button>
                <h4 class="modal-title">Заявка на услугу</h4>
            </div>
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                        'id'=>'callback-service-form-modal',
                        'type' => 'vertical',
                        'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
                    ]); ?>

                    <?php if (Yii::app()->user->hasFlash($sucssesId)) : ?>
                        <div class="modal-success-message" style="color: green; text-align: center; padding: 35px 0px; font-size: 16px;"><?= Yii::app()->user->getFlash($sucssesId) ?></div>
                       <script>
                            $('.modal-body').hide();
                            $('.modal-footer').hide();
                            $('.modal-title').hide();
                            setTimeout(function(){
                                $('#callbackServiceModal').modal('hide');
                            }, 2000);
                           setTimeout(function(){
                                $('.modal-success-message').remove();
                                $('.modal-body').show();
                                $('.modal-footer').show();
                                $('.modal-title').show();
                            }, 5000);
                        </script>


                    <?php endif ?>
                    <div class="modal-body">
                        <?= $form->textFieldGroup($model, 'name', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'autocomplete' => 'off'
                                ]
                            ]
                        ]); ?>

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
                            <?php echo $form->error($model, 'phone'); ?>
                        </div>

                        <?= $form->dropDownListGroup($model, 'services', [
                            'widgetOptions' => [
                                'data' => $model->getServicesList(),
                            ]
                        ]) ?>
                         <?= $form->textAreaGroup($model, 'body',[
                                'widgetOptions'=>[
                                    'htmlOptions'=>[
                                        'class' => '',
                                        'placeholder' => 'Комментарий',
                                        'autocomplete' => 'off'
                                    ]
                                ]
                            ]) ?>
                        <?= $form->hiddenField($model, 'verify'); ?>
                        <div class="form-bot">
                            <div class="form-captcha">
                                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
                                <?= $form->error($model, 'verifyCode');?>
                            </div>
                            <div class="form-button">
                                <?= CHtml::submitButton('Отправить', [
                                    'id' => 'callback-modal-button',
                                    'class' => 'blue',
                                    'data-send'=>'ajax'
                                ]) ?>
                            </div>
                        </div>

                    </div>


                <?php $this->endWidget(); ?>
        </div>
    </div>
</div>