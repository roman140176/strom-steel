<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
  'id' => 'form-qwues',
  'type' => 'vertical',
  'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
]); ?>

<div class="form-flex">
  <h2 class="page_title">Остались вопросы?</h2>
  <small style="width: 100%;line-height: 1.2;display: block;margin-bottom: 15px">Заполните форму<br>Наши специалисты свяжуться с Вами в ближайжее время</small>
  <div class="inputs-wrap">
    <?= $form->textFieldGroup($model, 'name', [
      'widgetOptions' => [
        'htmlOptions' => [
          'class' => '',
          'placeholder' => 'Ваше имя*',
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
          'placeholder' => 'Ваш телефон*',
          'autocomplete' => 'off'
        ]
      ]) ?>
    </div>
    <?= $form->error($model, 'phone'); ?>
  </div>
  <div class="textarea">
    <?= $form->textAreaGroup($model, 'body', [
      'widgetOptions' => [
        'htmlOptions' => [
          'class' => '',
          'placeholder' => 'Комментарий*',
          'autocomplete' => 'off'
        ]
      ]
    ]) ?>
  </div>
  <?= $form->hiddenField($model, 'code'); ?>
  <div class="p_wrap">
    <div class="form-captcha">
      <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
      <?= $form->error($model, 'verifyCode'); ?>
    </div>
    <div class="sender_box">
      <div class="politic" id="politic">
        <input type="checkbox" id="checker" class="checkbox" checked="true">
        <label for="checker"></label>
        <a href="/politika-konfidencialnosti">Нажимая кнопку "Отправить", Вы соглашаетесь<br> с <span>правилами обработки персональных данных</span></a>
      </div>
      <button id="form-button" class="garanty-btn" data-send="ajax">Связаться с нами</button>
    </div>

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
<script>
  var checker = document.getElementById('checker');
  var fBtn = document.getElementById('form-button');
  checker.addEventListener('click', function() {
    if (!this.checked) {
      fBtn.classList.add('disabled')
    } else {
      fBtn.classList.remove('disabled')

    }
  });
</script>