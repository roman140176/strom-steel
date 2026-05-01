<div id="CallbackProduct" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <noindex>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="modal-title">Заполните форму отправки</div>
        </div>
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
          'id' => 'callback-prod-modal',
          'type' => 'vertical',
          'htmlOptions' => ['class' => '', 'data-type' => 'ajax-form'],
        ]); ?>

        <?php if (Yii::app()->user->hasFlash($this->succesId)) : ?>
          <div class="modal-success-message" style="color: green; text-align: center; padding: 35px 0px; font-size: 16px;">
            <?= Yii::app()->user->getFlash($this->succesId) ?>
          </div>
          <script>
            $('.modal-body').hide();
            $('.modal-footer').hide();
            $('.modal-title').hide();
            setTimeout(function() {
              $('#CallbackProduct').modal('hide');
            }, 2000);
            setTimeout(function() {
              location.reload();
            }, 1000);
          </script>

        <?php else : ?>
          <div class="modal-body">
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
                  'autocomplete' => 'off',
                  'id' => 'phone-id',
                ]
              ]) ?>
            </div>
            <?= $form->hiddenField($model, 'verify'); ?>
            <?= $form->hiddenField($model, 'prodName'); ?>
            <?= $form->textAreaGroup($model, 'body', [
              'widgetOptions' => [
                'htmlOptions' => [
                  'class' => '',
                  'placeholder' => 'Ваш вопрос'
                ]
              ]
            ]) ?>
            <div class="form-bot">
              <div class="form-captcha">
                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
                <?= $form->error($model, 'verifyCode'); ?>
              </div>
              <div class="form-button">
                <button type="submit" class="contact-us" data-send="ajax" id=" callback-prod-button">
                  Отправить
                </button>
              </div>
            </div>
            <div class="terms_of_use">
              * Нажимая на кнопку "Отправить", я даю согласие на обработку моих персональных данных в соответствии с <a style="display:inline" href="/politika-konfidencialnosti" target="_blank">Соглашением об обработке персональных данных</a>
            </div>
          </div>
        <?php endif ?>
        <?php $this->endWidget(); ?>
      </noindex>
    </div>
  </div>
</div>