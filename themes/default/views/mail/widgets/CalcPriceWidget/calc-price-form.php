<?php
Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
?>
<div class="section calc-price-form" id="form-section">
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id' => 'form-main',
    'type' => 'vertical',
    'htmlOptions' => ['class' => 'form-file', 'data-type' => 'ajax-form', 'enctype' => 'multipart/form-data'],
  ]); ?>

  <div class="calc-price-form_row">
    <div class="form-group form-group_dropdown">

      <label for="CalcPriceModel_type" class="control-label">
        Тип металла <span class="required">*</span>
      </label>
      <div class="dropdown">
        <div class="dropdown-button">
          Выберите тип
          <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M11.248 5.93945L7.49805 9.68945L3.74805 5.93945" stroke="black" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          </svg>
        </div>
        <div class="dropdown-content">
          <div class="dropdown-item">Сталь черная</div>
          <div class="dropdown-item">Сталь нержавеющая</div>
          <div class="dropdown-item">Алюминий</div>
          <div class="dropdown-item">Латунь</div>
          <div class="dropdown-item">Медь</div>
        </div>
      </div>

      <input type="hidden" name="CalcPriceModel[type]" id="CalcPriceModel_type">
    </div>

    <?= $form->textFieldGroup($model, 'thickness', [
      'widgetOptions' => [
        'htmlOptions' => [
          'class' => '',
          'autocomplete' => 'off'
        ]
      ]
    ]); ?>

    <?= $form->textFieldGroup($model, 'meters', [
      'widgetOptions' => [
        'htmlOptions' => [
          'class' => '',
          'autocomplete' => 'off'
        ]
      ]
    ]); ?>

    <?= $form->textFieldGroup($model, 'burning', [
      'widgetOptions' => [
        'htmlOptions' => [
          'class' => '',
          'autocomplete' => 'off'
        ]
      ]
    ]); ?>
  </div>

  <div class="calc-price-form_row">
    <?= $form->textFieldGroup($model, 'name', [
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

    <?= $form->textFieldGroup($model, 'email', [
      'widgetOptions' => [
        'htmlOptions' => [
          'class' => '',
          'autocomplete' => 'off',
          'placeholder' => 'E-mail',
        ]
      ]
    ]); ?>

    <div class="file-upload">
      <label class="vision">
        <div id="count_file">
          Прикрепить файл
        </div>
        <label for="CalcPriceModel_file" class="custom-file-upload">Выбрать файл</label>
        <?= $form->fileField($model, 'file'); ?>

      </label>
      <?= $form->error($model, 'file'); ?>
    </div>
  </div>

  <div class="calc-price-form_row">
    <button type="submit" class="calc-price-send" data-send="ajax" id="complect-button">
      Рассчитать
    </button>
    <div class="terms-use">
      <span>* Нажимая на кнопку "Отправить", я даю согласие на обработку моих персональных данных в соответствии с Соглашением об обработке персональных данных</span>
    </div>
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