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
            <?=  $form->textAreaGroup($model, 'preview_text', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    'rows' => 4,
                    'cols' => 50,
                    'data-original-title' => $model->getAttributeLabel('preview_text'),
                    'data-content' => $model->getAttributeDescription('preview_text')
                ]
            ]]); ?>
            <p class="hint" style="margin: -10px 0 20px;">Если заполнено — в карусели на сайте показывается этот короткий текст, а полный «Ваш отзыв» открывается по клику «Читать полностью». Если пусто — выводится полный текст без триггера.</p>
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
    <div class='row'>
        <div class="col-sm-7">
            <label class="control-label">Аватар (фото клиента)</label>
            <?php if (!$model->isNewRecord && $model->image): ?>
                <div style="margin-bottom: 10px;">
                    <?= CHtml::image(
                        $model->getImageUrl(120, 120),
                        $model->username,
                        [
                            'class' => 'preview-image',
                            'style' => 'border-radius: 50%; width: 80px; height: 80px; object-fit: cover; display: block;',
                        ]
                    ); ?>
                </div>
                <div class="checkbox" style="margin-bottom: 10px;">
                    <label>
                        <input type="checkbox" name="delete-file" value="1"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                    </label>
                </div>
            <?php endif; ?>
            <?= $form->fileFieldGroup($model, 'image'); ?>
            <p class="hint" style="margin: -10px 0 20px;">JPG / PNG. Будет показан в карусели на сайте круглым превью.</p>
        </div>
    </div>
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