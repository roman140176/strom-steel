<?php
Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
 ?>
    <div class="form-flex in-page">
    <h2 class="form-header">Расскажите нам<br>
                            <span>о вашем проекте</span>
    </h2>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
        'id'=>'form-page',
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'form-file', 'data-type' => 'ajax-form','enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="inputs-wrap">
        <?= $form->textFieldGroup($model, 'name', [
            'widgetOptions'=>[
                'htmlOptions'=>[
                    'class' => '',
                    'autocomplete' => 'off'
                ]
            ]
        ]); ?>
        <?= $form->textFieldGroup($model, 'email', [
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
            </div>

       </div>

  <div class="txt-wrap">
    <?= $form->textAreaGroup($model, 'body') ?>
  </div>
  <div class="form-footer">
      <div class="terms-use">
          <input type="checkbox" name="use" id="checkbox">
          <label for="checkbox"></label>
          <span>Согласие на обработку <a href="#">персональных данных</a></span>
      </div>
      <div class="file-upload">
            <label class="vision">
                <?= $form->fileField($model, 'image'); ?>
                   <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/paperclip.svg'); ?>
                    <div id="count_file2">
                       Прикрепить файл
                    </div>

            </label>
            <?= $form->error($model, 'image'); ?>
    </div>
    <div class="form-captcha">
        <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
        <?= $form->error($model, 'verifyCode');?>
    </div>
  </div>
  <button type="submit" class="blue" data-send="ajax" id="complect-page">
  Отправить сообщение
  <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/plus.svg'); ?>
 </button>
<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div id="messageModal2" class="modal fade in" role="dialog">
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
        $('#messageModal2').modal('show');
        setTimeout(function(){
            $('#messageModal2').modal('hide');
        }, 5000);
    </script>
<?php endif ?>
<?php $this->endWidget() ?>
   </div>


