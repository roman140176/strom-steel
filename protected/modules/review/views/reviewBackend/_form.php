<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 *
 *   @var $model Review
 *   @var $form TbActiveForm
 *   @var $this ReviewBackendController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id'                     => 'review-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('ReviewModule.review', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('ReviewModule.review', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

<?=  $form->hiddenField($model, 'validate', [
    'value' => "1"
]); ?>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'product_id', [
                'widgetOptions' => [
                    'data' => $model->getProductList(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('product_id'),
                        'data-content' => $model->getAttributeDescription('product_id'),
                        'empty' => '--Выберите товар --'
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'username', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('username'),
                        'data-content' => $model->getAttributeDescription('username')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->dateTimePickerGroup($model,'date_created', [
            'widgetOptions' => [
                'options' => [],
                'htmlOptions'=>[]
            ],
            'prepend'=>'<i class="fa fa-calendar"></i>'
        ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textAreaGroup($model, 'text', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    'rows' => 6,
                    'cols' => 50,
                    'data-original-title' => $model->getAttributeLabel('text'),
                    'data-content' => $model->getAttributeDescription('text')
                ]
            ]]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <!-- <label for="">Оценка работы (от 1 - 5)</label> -->
            <?=  $form->textFieldGroup($model, 'rating', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    "placeholder" => 'Оценка работы (от 1 - 5)',
                    'data-original-title' => $model->getAttributeLabel('rating'),
                    'data-content' => $model->getAttributeDescription('rating')
                ],
            ]]); ?>
            <p class="hint" style="margin: -10px 0 20px; ">Оценка работы (от 1 - 5)</p>
        </div>
    </div>    
    <!-- <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'useremail', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('useremail'),
                        'data-content' => $model->getAttributeDescription('useremail')
                    ]
                ]
            ]); ?>
        </div>
    </div> -->
    <!-- <div class='row'>
        <div class="col-sm-7">
            <?php
            echo CHtml::image(
                !$model->isNewRecord && $model->image ? $model->getImageUrl(200,200) : '#',
                $model->username,
                [
                    'class' => 'preview-image',
                    'style' => !$model->isNewRecord && $model->image ? '' : 'display:none',
                ]
            ); ?>
    
            <?php if (!$model->isNewRecord && $model->image): ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="delete-file"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                    </label>
                </div>
            <?php endif; ?>
    
            <?= $form->fileFieldGroup($model, 'image'); ?>
        </div>
    </div> -->
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'moderation', [
                'widgetOptions' => [
                    'data' => $model->getModerationList(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('moderation'),
                        'data-content' => $model->getAttributeDescription('moderation')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('ReviewModule.review', 'Сохранить Отзыв и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('ReviewModule.review', 'Сохранить Отзыв и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>