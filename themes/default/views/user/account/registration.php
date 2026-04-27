<?php
$this->title = Yii::t('UserModule.user', 'Sign up');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Sign up')];
Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
?>

<div class="lk-content">
    <div class="content">

        <div class="lk-form">
            <h1 class="page_title text-center"><?= Yii::t('UserModule.user', 'Регистрация'); ?></h1>


            <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

            <script type='text/javascript'>
                $(document).ready(function () {
                    function str_rand(minlength) {
                        var result = '';
                        var words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
                        var max_position = words.length - 1;
                        for (i = 0; i < minlength; ++i) {
                            position = Math.floor(Math.random() * max_position);
                            result = result + words.substring(position, position + 1);
                        }
                        return result;
                    }

                    $('#generate_password').click(function () {
                        var pass = str_rand($(this).data('minlength'));
                        $('#RegistrationForm_password').attr('type', 'text');
                        $('#RegistrationForm_password').val(pass);
                        $('#RegistrationForm_cPassword').val(pass);
                    });
                })
            </script>
            <?php $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'id' => 'registration-form',
                    'type' => 'vertical',
                    'htmlOptions' => [
                        'class' => 'registration-form form-white',
                    ]
                ]
            ); ?>

            <?= $form->errorSummary($model); ?>

                <?php if (!$this->module->generateNickName) : ?>
                    <?php /*= $form->textFieldGroup($model, 'nick_name', [
                    'widgetOptions'=>[
                        'htmlOptions'=>[
                            'placeholder' => 'Логин',
                            'autocomplete' => 'off'
                        ]
                    ]
                ]);*/ ?>
                <?php endif; ?>

            <?= $form->textFieldGroup($model, 'first_name'); ?>
            <?= $form->textFieldGroup($model, 'email'); ?>
            <div class="form-group">
                <?= $form->labelEx($model, 'phone', ['class' => 'control-label']) ?>
                <?php $this->widget('CMaskedTextFieldPhone', [
                    'model' => $model,
                    'attribute' => 'phone',
                    'mask' => '+7-999-999-9999',
                    'htmlOptions'=>[
                        'class' => 'data-mask form-control',
                        'data-mask' => 'phone',
                        'placeholder' => 'Телефон',
                        'autocomplete' => 'off'
                    ]
                ]) ?>
            </div>

            <?= $form->passwordFieldGroup($model, 'password', [
                'groupOptions'=>[
                    'class'=>'password-form-group',
                ],
                'appendOptions' => [
                    'class'=>'password-input-show',
                ],
                'append' => '<i class="fa fa-eye" aria-hidden="true"></i>'
            ]); ?>

            <div class="form-bot">
                <div class="form-captcha">
                    <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                    </div>
                    <?= $form->error($model, 'verifyCode');?>
                </div>
                <div class="form-button">
                    <button class="but but-pink" id="registration-btn" data-send="ajax">
                        Зарегистрироваться
                    </button>
                </div>
            </div>

            <div class="terms_of_use"> * Нажимая на кнопку "Зарегистрироваться", я даю согласие на обработку моих персональных данных в соответствии с <a target="_blank" href="/politika-konfidencialnosti" style="display: inline-block">Согласием об обработке персональных данных</a></div>

            <?php if (Yii::app()->hasModule('social')) :
                { ?>
                <hr/>
                <?php $this->widget(
                    'vendor.nodge.yii-eauth.EAuthWidget',
                    [
                        'action' => '/social/login',
                        'predefinedServices' => ['google', 'facebook', 'vkontakte', 'twitter', 'github'],
                    ]
                ); ?>
                <?php }
            endif; ?>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>