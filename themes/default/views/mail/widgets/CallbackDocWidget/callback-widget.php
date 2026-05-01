<div id="callbackDocModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Закрыть">
                    <span aria-hidden="true"></span>
                </button>
                <h4 class="modal-title">Запись на приём</h4>
            </div>
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                        'id'=>'callback-doc-form-modal',
                        'type' => 'vertical',
                        'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
                    ]); ?>

                    <?php if (Yii::app()->user->hasFlash('success1')) : ?>
                        <div class="modal-success-message" style="color: green; text-align: center; padding: 35px 0px; font-size: 16px;"><?= Yii::app()->user->getFlash('success1') ?></div>
                        <script>
                            $('.modal-body').hide();
                            $('.modal-footer').hide();
                            setTimeout(function(){
                                $('#callbackDocModal').modal('hide');
                            }, 2000);
                           setTimeout(function(){
                                $('.modal-success-message').remove();
                                $('.modal-body').show();
                                $('.modal-footer').show();
                            }, 5000);
                        </script>
                    <?php endif ?>
                    <div class="modal-body">
                        <?= $form->textFieldGroup($model, 'name', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'autocomplete' => 'off',
                                    'placeholder' => 'ФИО*'
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
                                    'placeholder' => 'Телефон*',
                                    'autocomplete' => 'off'
                                ]
                            ]) ?>
                        </div>

                       <?= $form->textFieldGroup($model, 'email', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'autocomplete' => 'off',
                                    'placeholder' => 'Почта*'
                                ]
                            ]
                        ]); ?>
                       <?= $form->textFieldGroup($model, 'adress', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'autocomplete' => 'off',
                                    'placeholder' => 'Адрес*'
                                ]
                            ]
                        ]); ?>
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
                                    'id' => 'callback-doc-button',
                                    'class' => '',
                                    'data-send'=>'ajax'
                                ]) ?>
                            </div>
                        </div>

                    </div>


                <?php $this->endWidget(); ?>
        </div>
    </div>
</div>