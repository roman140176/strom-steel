<?php
/**
 * @var TbActiveForm $form
 */

$this->title = Yii::t('UserModule.user', 'Password recovery');

Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
?>

<div class="lk-content">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <div class="lk-form">
            <h1><?= Yii::t('UserModule.user', 'Password recovery') ?></h1>

            <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                'id' => 'recovery-form',
                'type' => 'vertical',
                'htmlOptions' => ['class' => 'recovery-form form-white'],
            ]); ?>

                <?= $form->textFieldGroup($model, 'email', [
                    'labelOptions' => [
                        'label' => false
                    ],
                    'widgetOptions'=>[
                        'htmlOptions'=>[
                            //'placeholder' => Yii::t('UserModule.user', 'Enter an email you have used during signup'),
                            'autocomplete' => 'off'
                        ]
                    ]
                ]); ?>

                <div class="form-bot">
                    <div class="form-captcha">
                        <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                        </div>
                        <?= $form->error($model, 'verify');?>
                    </div>
                    <div class="form-button">
                        <button class="but but-pink" id="recovery-btn" data-send="ajax">
                            <?= Yii::t('UserModule.user', 'Recover password'); ?>
                        </button>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
