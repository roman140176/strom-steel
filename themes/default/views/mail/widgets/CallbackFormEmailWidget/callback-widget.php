<noindex>
  <div id="CallbackFormEmail" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="modal-title">Заполните форму отправки</div>
        </div>
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
          'id' => 'callback-form-emailmodal',
          'type' => 'vertical',
          'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
        ]); ?>

        <?php if (Yii::app()->user->hasFlash('successId')) : ?>
          <div class="modal-success-message" style="color: green; text-align: center; padding: 35px 0px; font-size: 16px;">
            <?= Yii::app()->user->getFlash('successId') ?>
          </div>
          <script>
            yaCounter68294278.reachGoal('form');
            $('.modal-body').hide();
            $('.modal-footer').hide();
            $('.modal-title').hide();
            setTimeout(function() {
              $('#CallbackFormEmail').modal('hide');
            }, 2000);
            setTimeout(function() {
              $('.modal-success-message').remove();
              $('.modal-body').show();
              $('.modal-footer').show();
            }, 5000);
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
                  'autocomplete' => 'off'
                ]
              ]) ?>
            </div>
            <?= $form->hiddenField($model, 'verify'); ?>
            <?= $form->textAreaGroup($model, 'body') ?>
            <?= $form->hiddenField($model, 'verify'); ?>
            <?= $form->hiddenField($model, 'utm_source', [
              'value' => $model->getUtmSource(),
            ]); ?>
            <?= $form->hiddenField($model, 'utm_medium', [
              'value' => $model->getUtmMedium(),
            ]); ?>
            <?= $form->hiddenField($model, 'utm_campaign', [
              'value' => $model->getUtmCampaing(),
            ]); ?>
            <?= $form->hiddenField($model, 'utm_content', [
              'value' => $model->getUtmContent(),
            ]); ?>
            <?= $form->hiddenField($model, 'utm_term', [
              'value' => $model->getUtmTerm(),
            ]); ?>
            <div class="form-bot">
              <div class="form-captcha">
                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
                <?= $form->error($model, 'verifyCode'); ?>
              </div>
              <div class="form-button">
                <button type="submit" class="contact-us js-button" data-send="ajax" id="callback-emailform-button">Отправить</button>
              </div>
            </div>
            <div class="terms_of_use"> * Нажимая на кнопку "Отправить", я даю согласие на обработку моих персональных данных в соответствии с <a style="display:inline" href="/politika-konfidencialnosti" target="_blank">Соглашением об обработке персональных данных</a></div>
          </div>

        <?php endif ?>


        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</noindex>