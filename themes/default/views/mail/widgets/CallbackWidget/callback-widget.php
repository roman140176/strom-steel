<noindex>
  <div id="callbackModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
            <span aria-hidden="true">&times;</span>
          </button>
          <!-- <h4 class="modal-title"></h4> -->
          <div class="modal-title">
            <span>Заказать звонок</span>
          </div>
        </div>
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
          'id' => 'callback-form-head',
          'type' => 'vertical',
          'action' => '/',
          'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
        ]); ?>

        <?php if (Yii::app()->user->hasFlash($sucssesId)) : ?>
          <div class="modal-success-message" style="color: green; text-align: center; padding: 35px 0px; font-size: 16px;">
            <?= Yii::app()->user->getFlash($sucssesId) ?>
          </div>
          <script>
            $('.modal-body').hide();
            $('.modal-title').hide();
            $('.modal-footer').hide();
            setTimeout(function() {
              $('#callbackModal').modal('hide');
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
                  'placeholder' => 'Ваше имя',
                  'autocomplete' => 'off'
                ]
              ]
            ]); ?>


            <?= $form->telFieldGroup($model, 'phone', [
              'widgetOptions' => [
                'htmlOptions' => [
                  'data-mask' => "phone",
                  'class' => 'data-mask'
                ]
              ]
            ]) ?>

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
                <button type="submit" class="redButton" data-send="ajax" id="callback-form-modal">Отправить</button>
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