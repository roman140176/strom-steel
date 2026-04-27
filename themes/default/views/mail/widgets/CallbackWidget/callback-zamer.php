<noindex>
  <div id="callbackModal2" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Вызов замерщика</h4>
        </div>
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
          'id' => 'callback-form-zamer',
          'type' => 'vertical',
          'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
        ]); ?>

        <?php if (Yii::app()->user->hasFlash($sucssesId)) : ?>
          <div class="modal-success-message" style="color: green; text-align: center; padding: 35px 0px; font-size: 16px;">
            <?= Yii::app()->user->getFlash($sucssesId) ?>
          </div>
          <?php
          Yii::app()->clientScript->registerScript("callbackHeader", "
                                    $('.modal-body').hide();
                                    $('.modal-footer').hide();
                                    setTimeout(function(){
                                        $('#callbackModal2').modal('hide');
                                    }, 2000);
                                   setTimeout(function(){
                                        $('.modal-success-message').remove();
                                        $('.modal-body').show();
                                        $('.modal-footer').show();
                                    }, 5000);

                                ");
          ?>
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
            <div class="form-bot">
              <div class="form-captcha">
                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
                <?= $form->error($model, 'verifyCode'); ?>
              </div>
              <div class="form-button">
                <button type="submit" class="blue" data-send="ajax" id="callback-form-zamer">Отправить</button>
              </div>
            </div>
            <div class="terms_of_use"> * Нажимая на кнопку "Отправить", я даю согласие на обработку моих
              персональных данных в соответствии с <a style="display:inline" href="/uploads/docs/plt.pdf" target="_blank">Соглашением об обработке персональных данных</a></div>
          </div>
        <?php endif ?>


        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</noindex>