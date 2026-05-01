<?php
/**
 * @var $this CatalogBackendController
 * @var $model StoreCategory
 * @var $form \yupe\widgets\ActiveForm
 */
?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("StoreModule.store", "Common"); ?></a></li>
    <li><a href="#options" data-toggle="tab"><?= Yii::t("StoreModule.store", "More options"); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t("StoreModule.store", "SEO"); ?></a></li>
</ul>

<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        'id' => 'category-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>

<div class="alert alert-info">
    <?= Yii::t('StoreModule.store', 'Fields with'); ?>
    <span class="required">*</span>
    <?= Yii::t('StoreModule.store', 'are required'); ?>
</div>

<?= $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="common">
        <div class="row">
            <div class="col-sm-3">
                <br/>
                <?= $form->checkBoxGroup($model, 'is_home'); ?>
            </div>
            <div class="col-sm-3">
                <br/>
                <?= $form->checkBoxGroup($model, 'is_card_big'); ?>
            </div>
            <div class="col-sm-3">
                <br/>
                <?= $form->textFieldGroup($model, 'sort'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'parent_id',
                    [
                        'widgetOptions' => [
                            'data' => StoreCategoryHelper::formattedList(),
                            'htmlOptions' => [
                                'empty' => Yii::t('StoreModule.store', '--no--'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->dropDownListGroup(
                    $model,
                    'status',
                    [
                        'widgetOptions' => [
                            'data' => $model->getStatusList(),
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'name'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-7">
                <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'name']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?= $form->textFieldGroup($model, 'title'); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->textFieldGroup($model, 'desc_title'); ?>
            </div>
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'units'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'linked_id',
                    [
                        'widgetOptions' => [
                            'data' => $model->selectProducts(),
                            'htmlOptions' => [
                                'empty' => Yii::t('StoreModule.store', '--no--'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-4">
                <div class="preview-image-wrapper<?= !$model->isNewRecord && $model->image ? '' : ' hidden' ?>">
                    <div class="btn-group image-settings">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="collapse"
                                data-target="#image-settings"><span class="fa fa-gear"></span></button>
                        <div id="image-settings" class="dropdown-menu">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?= $form->textFieldGroup($model, 'image_alt'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?= $form->textFieldGroup($model, 'image_title'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    echo CHtml::image(
                        !$model->isNewRecord && $model->image ? $model->getImageUrl() : '#',
                        $model->name,
                        [
                            'class' => 'preview-image img-thumbnail',
                            'style' => !$model->isNewRecord && $model->image ? '' : 'display:none'
                        ]
                    ); ?>
                </div>
                <?= $form->fileFieldGroup(
                    $model,
                    'image',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'onchange' => 'readImageURL(this, ".preview-image");',
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-3">
                <div class="preview-image-wrapper<?= !$model->isNewRecord && $model->thumbnale ? '' : ' hidden' ?>">


                    <?php
                    echo CHtml::image(
                        !$model->isNewRecord && $model->image ? $model->getImageUrl(0,0,true,null,'thumbnale') : '#',
                        $model->name,
                        [
                            'class' => 'preview-thumbnail img-thumbnail',
                            'style' => !$model->isNewRecord && $model->thumbnale ? '' : 'display:none'
                        ]
                    ); ?>
                </div>
                <?= $form->fileFieldGroup(
                    $model,
                    'thumbnale',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'onchange' => 'readImageURL(this, ".preview-thumbnail");',
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-12">
                <?= $form->textAreaGroup(
                    $model,
                    'svg_code',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'rows' => 6,
                                'style' => 'font-family: monospace;',
                                'placeholder' => '<svg xmlns="http://www.w3.org/2000/svg" ...>...</svg>',
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-12 <?= $model->hasErrors('description') ? 'has-error' : ''; ?>">
                <?= $form->labelEx($model, 'description'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'description',
                    ]
                ); ?>
                <p class="help-block"></p>
                <?= $form->error($model, 'description'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-12 <?= $model->hasErrors('short_description') ? 'has-error' : ''; ?>">
                <?= $form->labelEx($model, 'short_description'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'short_description',
                    ]
                ); ?>
                <p class="help-block"></p>
                <?= $form->error($model, 'short_description'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-12 <?= $model->hasErrors('sertificate') ? 'has-error' : ''; ?>">
                <?= $form->labelEx($model, 'sertificate'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'sertificate',
                    ]
                ); ?>
                <p class="help-block"></p>
                <?= $form->error($model, 'sertificate'); ?>
            </div>
        </div>


    </div>

    <div class="tab-pane" id="options">
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'view'); ?>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="seo">
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'meta_title'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'meta_keywords'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textAreaGroup($model, 'meta_description'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'meta_canonical'); ?>
            </div>
        </div>
    </div>
</div>



<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('StoreModule.store', 'Create category and continue') : Yii::t('StoreModule.store', 'Save category and continue'),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->isNewRecord ? Yii::t('StoreModule.store', 'Create category and close') : Yii::t('StoreModule.store', 'Save category and close'),
    ]
); ?>

<?php $this->endWidget(); ?>
