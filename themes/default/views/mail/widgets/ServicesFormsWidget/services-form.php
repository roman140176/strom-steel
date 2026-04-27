<?php
Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
?>
<div class="section services-form" id="form-section">
  <div class="form-flex">
    <h3>
      Напишите нам
    </h3>

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
      'id' => 'form-main',
      'type' => 'vertical',
      'htmlOptions' => ['class' => 'form-file', 'data-type' => 'ajax-form', 'enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="inputs-wrap">
      <?= $form->textFieldGroup($model, 'name', [
        'widgetOptions' => [
          'htmlOptions' => [
            'class' => '',
            'autocomplete' => 'off'
          ]
        ]
      ]); ?>
      <?= $form->textFieldGroup($model, 'email', [
        'widgetOptions' => [
          'htmlOptions' => [
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
          'htmlOptions' => [
            'class' => 'data-mask form-control',
            'data-mask' => 'phone',
            'placeholder' => 'Телефон',
            'autocomplete' => 'off'
          ]
        ]) ?>
      </div>

      <div class="form-group">
        <?= $form->textAreaGroup($model, 'body', [
          'widgetOptions' => [
            'htmlOptions' => [
              'placeholder' => 'Текст сообщения',
            ]
          ]
        ]) ?>
      </div>
    </div>

    <div class="form-footer">
      <div class="file-upload">
        <label class="vision">
          <div id="count_file">
            Прикрепить файл
          </div>
          <label for="ServicesFormsModel_file" class="custom-file-upload">Выбрать файл</label>
          <?= $form->fileField($model, 'file'); ?>

        </label>
        <?= $form->error($model, 'file'); ?>
      </div>
      <div class="form-captcha">
        <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
        <?= $form->error($model, 'verifyCode'); ?>
      </div>
    </div>
    <button type="submit" class="service-send" data-send="ajax" id="complect-button">
      Отправить
    </button>
    <div class="terms-use">
      <span>* Нажимая на кнопку "Отправить", я даю согласие на обработку моих персональных данных в соответствии с Соглашением об обработке персональных данных</span>
    </div>
    <?php if (Yii::app()->user->hasFlash('success')) : ?>
      <div id="messageModal" class="modal fade in" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
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
        $('#messageModal').modal('show');
        setTimeout(function() {
          $('#messageModal').modal('hide');
        }, 5000);
      </script>
    <?php endif ?>
    <?php $this->endWidget() ?>
  </div>
  <div class="form-img">
    <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/services/forms/' . $img) ?>
  </div>
</div>