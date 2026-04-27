<div id="reviewZayavkaModal" class="modal review-modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-heading">
                    <strong class="modal-heading__title">Оставить отзыв</strong><br>
                    Вы можете оставить свой отзыв. <br>Нам очень важно Ваше мнение.
                </div>
            </div>

            <?php Yii::app()->user->returnUrl = Yii::app()->request->requestUri;
                $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        // 'action'      => Yii::app()->createUrl('/review/create/'),
                        'id'          => 'review-form',
                        'type'        => 'vertical',
                        'htmlOptions' => [
                            'class' => 'form-rev-mod',
                            'data-type' => 'ajax-form',
                            // 'enctype' => 'multipart/form-data'
                        ],
                    ]
                ); ?>

                <?php if (Yii::app()->user->hasFlash('review-success')): ?>

                    <script>
                        $('#reviewZayavkaModal').modal('hide');
                        $('#reviewModal').modal('show');
                        setTimeout(function(){
                            $('#reviewModal').modal('hide');
                        }, 50000);

                    </script>
                <?php endif ?>
                <div class="modal-body">
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


                    <div class="raiting-form">
                        <div class="raiting-form__header">
                            Оцените качество
                        </div>
                        <div class="raiting-form__list raiting-list-form">
                            <div class="raiting-list-form__item" data-id="1"></div>
                            <div class="raiting-list-form__item" data-id="2"></div>
                            <div class="raiting-list-form__item" data-id="3"></div>
                            <div class="raiting-list-form__item" data-id="4"></div>
                            <div class="raiting-list-form__item" data-id="5"></div>
                        </div>
                    </div>

                    <div class="form-bot">
                        <div class="form-captcha">
                            <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                            </div>
                            <?= $form->error($model, 'verifyCode');?>
                        </div>
                        <div class="form-button">
                            <button class="but redButton" id="reviewZayavka-button" data-send="ajax">Отправить</button>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
