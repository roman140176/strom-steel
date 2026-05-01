<?php
$this->title = Yii::t('UserModule.user', 'Sign in');

Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
?>

<div class="lk-content">
    <div class="container">

        <div class="lk-form lk-form-sm-12">
            <div class="lk-form__left">
                    <h1><?= Yii::t('UserModule.user', 'Войти в личный кабинет'); ?></h1>

                    <?php //$this->widget('yupe\widgets\YFlashMessages'); ?>
                    <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                        [
                            'id' => 'login-form',
                            'type' => 'vertical',
                            'htmlOptions' => [
                                'class' => 'login-form form-white',
                            ]
                        ]
                    ); ?>

                        <?php //= $form->errorSummary($model); ?>


                        <?= $form->textFieldGroup($model, 'email', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'placeholder' => 'Ваш E-mail',
                                    'autocomplete' => 'off'
                                ]
                            ]
                        ]); ?>
                        <div class="login-form__item">
                            <?= $form->passwordFieldGroup($model, 'password', [
                                'groupOptions'=>[
                                    'class'=>'password-form-group',
                                ],
                                'appendOptions' => [
                                    'class'=>'password-input-show',
                                ],
                                'append' => '<i class="fa fa-eye" aria-hidden="true"></i>'
                            ]); ?>
                            <?= CHtml::link(Yii::t('UserModule.user', 'Forgot your password?'), ['/user/account/recovery'], [
                                'class' => 'login-form__link'
                            ]) ?>
                        </div>
                        <?php if ($this->getModule()->sessionLifeTime > 0): ?>
                            <!-- <div class="checkbox checkbox-one">
                                <input checked="checked" name="LoginForm[remember_me]" id="LoginForm_remember_me" value="1" type="checkbox">
                                <label for="LoginForm_remember_me">Запомнить меня</label>
                            </div> -->
                        <?php endif; ?>

                        <div class="form-bot">
                            <div class="form-captcha">
                                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                                </div>
                                <?= $form->error($model, 'verify');?>
                            </div>
                            <div class="form-button">
                                <button class="but but-pink" id="login-btn" data-send="ajax">
                                    Войти
                                </button>
                            </div>
                        </div>

                        <?php if (Yii::app()->hasModule('social')): ?>
                            <?php $this->widget(
                                'vendor.nodge.yii-eauth.EAuthWidget',
                                [
                                    'action' => '/social/login',
                                    'predefinedServices' => ['google', 'facebook', 'vkontakte', 'twitter', 'github'],
                                ]
                            ); ?>
                        <?php endif; ?>
                    <?php $this->endWidget(); ?>
            </div>
            <div class="lk-form__right">
                <div class="new-reg">
                    <h2><?= Yii::t('UserModule.user', 'Зарегистрируйтесь на'); ?><?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/logo.svg', ''); ?></h2>
                    <div class="new-reg__text">
                        <p>Зачем нужен личный кабинет?</p>
                        <p>В чём его преимущества?</p>
                        <p>Личный кабинет &laquo;Стром ТРЕЙД&raquo; это:</p>
                        <ul>
                            <li>Хранение истории заказов</li>
                            <li>Не нужно каждый раз вводить данные при оформлении заказа</li>
                        </ul>
                    </div>
                    <a class="but but-black" href="<?= Yii::app()->createUrl('user/account/registration'); ?>"><?= Yii::t('UserModule.user', 'Зарегистрироваться'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (Yii::app()->user->hasFlash("success")) : ?>
    <div id="registrationModal" class="modal modal-my fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div data-dismiss="modal" class="modal-close"><div></div></div>
                    <div class="modal-header__heading">
                        <div class="modal-header__h2">Уведомление</div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="message-success">
                        <?= Yii::app()->user->getFlash('success') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php Yii::app()->clientScript->registerScript("emails", "
        $('#registrationModal').modal('show');
        setTimeout(function(){
            $('#registrationModal').modal('hide');
        }, 6000);

    "); ?>
<?php endif; ?>