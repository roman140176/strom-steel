<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 *
 *   @var $model SitemapException
 *   @var $form TbActiveForm
 *   @var $this SitemapExceptionBackendController
 **/
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',[
        'id'                     => 'sitemap-exception-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => ['class' => 'well'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('SitemapModule.sitemap', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('SitemapModule.sitemap', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'exception_url', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('exception_url'),
                        'data-content' => $model->getAttributeDescription('exception_url')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'status', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('status'),
                        'data-content' => $model->getAttributeDescription('status')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('SitemapModule.sitemap', 'Сохранить Список исключений и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('SitemapModule.sitemap', 'Сохранить Список исключений и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>