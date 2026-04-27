<div class="review-form-box">
    <div class="review-form-box__header">
        <?php /*$this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
            'id' => 16
        ]);*/ ?>
    </div>
    <div class="review-form-box__form">
        <?php Yii::app()->user->returnUrl = Yii::app()->request->requestUri;
            $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'action'      => Yii::app()->createUrl('/review/create/'),
                    'id'          => 'review-form',
                    'type'        => 'vertical',
                    'htmlOptions' => [
                        'class' => 'form-my form-review',
                        'data-type' => 'ajax-form',
                        // 'enctype' => 'multipart/form-data'
                    ],
                ]
            ); ?>

                <?= $form->textFieldGroup($model, 'username', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'data-original-title' => $model->getAttributeLabel('username'),
                            'data-content'        => $model->getAttributeDescription('username'),
                            'autocomplete' => 'off'
                        ],
                    ],
                ]); ?>

                <?= $form->textAreaGroup($model, 'text', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'data-original-title' => $model->getAttributeLabel('text'),
                            'data-content'        => $model->getAttributeDescription('text'),
                            'autocomplete' => 'off'
                        ],
                    ],
                ]); ?>

                <?= $form->hiddenField($model, 'rating'); ?>

                <div class="rating-box">
                    <div class="rating-box__header">
                        <strong>Оцените </strong><strong>качество работы </strong>
                    </div>
                    <div class="rating-box__list raiting-list raiting-list-form">
                        <div class="raiting-list__item" data-id="1"></div>
                        <div class="raiting-list__item" data-id="2"></div>
                        <div class="raiting-list__item" data-id="3"></div>
                        <div class="raiting-list__item" data-id="4"></div>
                        <div class="raiting-list__item" data-id="5"></div>
                    </div>
                </div>

                <div class="form-bot form-bot-inline">
                    <div class="form-captcha">
                        <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                        </div>
                        <?= $form->error($model, 'verifyCode');?>
                    </div>
                    <div class="form-button">
                        <button class="but but-green" id="reviewZayavka-button" data-send="ajax">Отправить</button>
                    </div>
                </div>

                <?php if (Yii::app()->user->hasFlash('review-success')): ?>
                <div id="reviewModal" class="modal modal-my fade in" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div data-dismiss="modal" class="modal-close"><div></div></div>
                                <div class="modal-my-heading">
                                    <strong>Уведомление</strong>
                                </div>
                            </div>
                            <div class="modal-success-message">
                                Ваша отзыв успешно отправлен.
                            </div>
                        </div>
                    </div>
                </div>
                    <script>
                        $('#reviewModal').modal('show');
                        setTimeout(function(){
                            $('#reviewModal').modal('hide');
                        }, 5000);
                    </script>
                <?php endif ?>
        <?php $this->endWidget(); ?>
    </div>
</div>




