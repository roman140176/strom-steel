<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                        'id'=>'form-modal',
                        'type' => 'vertical',
                        'htmlOptions' => ['class' => 'form', 'data-type' => 'ajax-form'],
                    ]); ?>

<div class="row-flex">

    <div class="inputs-wrap">
        <div class="col-form">
        <?= $form->textFieldGroup($model, 'name', [
            'widgetOptions'=>[
                'htmlOptions'=>[
                    'class' => '',
                    'autocomplete' => 'off'
                ]
            ]
        ]); ?>
         </div>
         <div class="col-form">
           <?= $form->maskedTextFieldGroup($model, 'phone', [
                'widgetOptions' => [
                    'mask' => '+7(999)999-99-99',
                    'htmlOptions'=>[
                        'class' => 'data-mask',
                        'data-mask' => 'phone',
                        'placeholder' => 'Телефон',
                        'autocomplete' => 'off'
                    ]
                ]
            ]); ?>
         </div>
       </div>

  <div class="txt-wrap">
      <div class="txtar">
        <?= $form->textAreaGroup($model, 'body') ?>
    </div>
    <div class="dflex">
        <?= $form->hiddenField($model, 'code'); ?>
      <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>"></div>
             <?= $form->error($model, 'verifyCode');?>
    </div>
    <div class="sub_btn">
      <?= CHtml::submitButton('Отправить', [
        'id' => 'form-button',
        'class' => 'btn sub_but',
        'data-send'=>'ajax'
    ]) ?>
    </div>
  </div>
    <div class="gurle"></div>
   </div>
<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div id="messageModal" class="modal fade in" role="dialog">
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
        $('#messageModal').modal('show');
        setTimeout(function(){
            $('#messageModal').modal('hide');
        }, 5000);
    </script>
<?php endif ?>




<?php $this->endWidget() ?>


