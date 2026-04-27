<?php
/**
 * @var $this ProductBackendController
 * @var $model Product
 * @var $form \yupe\widgets\ActiveForm
 * @var ImageGroup $imageGroup
 */
?>
<?php Yii::app()->getClientScript()->registerCssFile($this->getModule()->getAssetsUrl().'/css/store-backend.css'); ?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("StoreModule.store", "Common"); ?></a></li>
    <li><a href="#attributes" data-toggle="tab"><?= Yii::t("StoreModule.store", "Attributes"); ?></a></li>
    <li><a href="#images" data-toggle="tab"><?= Yii::t("StoreModule.store", "Images"); ?></a></li>
    <li><a href="#files" data-toggle="tab">Файлы</a></li>
    <li><a href="#photos" data-toggle="tab">Сертификаты</a></li>
    <li><a href="#variants" data-toggle="tab"><?= Yii::t("StoreModule.store", "Variants"); ?></a></li>
    <li><a href="#stock" data-toggle="tab"><?= Yii::t("StoreModule.store", "Stock"); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t("StoreModule.store", "SEO"); ?></a></li>
    <li><a href="#linked" data-toggle="tab"><?= Yii::t("StoreModule.store", "Linked products"); ?></a></li>
</ul>

<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'well'],
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
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
        <?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); ?>
        <div class="panel-group" id="template-options">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <a data-toggle="collapse" data-parent="#template-options" href="#collapse-template">
                            <?= Yii::t('StoreModule.store', 'Templates settings'); ?>
                        </a>
                    </div>
                </div>
                <div id="collapse-template" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <?= $form->textFieldGroup($model, 'view'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <div class="row">
            <div class="col-sm-3">
                <br/>
                <?= $form->checkBoxGroup($model, 'is_home'); ?>
            </div>
            <div class="col-sm-3">
                <br/>
                <?= $form->checkBoxGroup($model, 'is_recomended'); ?>
            </div>
            <div class="col-sm-3">
                <br/>
                <?= $form->checkBoxGroup($model, 'is_new'); ?>
            </div>
            <div class="col-sm-3">
                <br/>
                <?= $form->checkBoxGroup($model, 'is_special'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->textFieldGroup($model, 'sku'); ?>
            </div>
            <div class="col-sm-3">
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
        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'category_id',
                    [
                        'widgetOptions' => [
                            'data' => StoreCategoryHelper::formattedList(),
                            'htmlOptions' => [
                                'empty' => '---',
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'producer_id',
                    [
                        'widgetOptions' => [
                            'data' => Producer::model()->getFormattedList(),
                            'htmlOptions' => [
                                'empty' => '---',
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-3">
                <?= $form->textFieldGroup($model, 'model_product'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'name'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'name']); ?>
            </div>
        </div>
        <div class="row">
             <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'casing'); ?>
            </div>
             <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'platband'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'price'); ?>
            </div>
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'discount_price'); ?>
            </div>
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'discount'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_price"
                               href="#collapse_price">
                                <?= Yii::t("StoreModule.store", 'Additional price'); ?>
                            </a>
                        </div>
                        <div id="collapse_price" class="panel-collapse collapse" style="height: 0px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->textFieldGroup($model, 'purchase_price'); ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->textFieldGroup($model, 'average_price'); ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->textFieldGroup($model, 'recommended_price'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-12">&nbsp;</div>
        </div>
        <div class='row'>
            <div class="col-sm-7">
                <div class="form-group">
                    <?php $this->widget(
                        'store.widgets.CategoryTreeWidget',
                        [
                            'selectedCategories' => $model->getCategoriesId(),
                            'id' => 'category-tree',
                        ]
                    ); ?>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-7">
                <div class="preview-image-wrapper<?= !$model->getIsNewRecord() && $model->image ? '' : ' hidden' ?>">
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
                    <?=
                    CHtml::image(
                        !$model->getIsNewRecord() && $model->image ? $model->getImageUrl(200, 200, true) : '#',
                        $model->name,
                        [
                            'class' => 'preview-image img-thumbnail',
                            'style' => !$model->getIsNewRecord() && $model->image ? '' : 'display:none',
                        ]
                    ); ?>
                </div>

                <?php if (!$model->getIsNewRecord() && $model->image): ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="delete-file"> <?= Yii::t(
                                'YupeModule.yupe',
                                'Delete the file'
                            ) ?>
                        </label>
                    </div>
                <?php endif; ?>

                <?= $form->fileFieldGroup(
                    $model,
                    'image',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'onchange' => 'readURL(this);',
                            ],
                        ],
                    ]
                ); ?>
            </div>

        </div>
        <div class="row">
              <div class="col-sm-5">
                    <?php
                    echo CHtml::image(
                        !$model->isNewRecord && $model->icon_color ? $model->getImageUrl(50,50,true,null,'icon_color') : '#',
                        '',
                        [
                            'class' => 'preview-icon-color',
                            'style' => !$model->isNewRecord && $model->icon_color ? '' : 'display: none',
                        ]
                    ); ?>

                    <?php if (!$model->isNewRecord && $model->icon_color): ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="delete-icon_color"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                            </label>
                        </div>
                    <?php endif; ?>

                    <?= $form->fileFieldGroup(
                        $model,
                        'icon_color',
                        [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'onchange' => 'readImageURL(this, ".preview-icon-color");',
                                    'style' => 'background-color: inherit;',
                                ],
                            ],
                        ]
                    ); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->textFieldGroup($model, 'icon_out'); ?>
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
            <div class="col-sm-12 <?= $model->hasErrors('data') ? 'has-error' : ''; ?>">
                <?= $form->labelEx($model, 'data'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'data',
                    ]
                ); ?>
                <p class="help-block"></p>
                <?= $form->error($model, 'data'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-12 <?= $model->hasErrors('txt') ? 'has-error' : ''; ?>">
                <?= $form->labelEx($model, 'txt'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'txt',
                    ]
                ); ?>
                <p class="help-block"></p>
                <?= $form->error($model, 'txt'); ?>
            </div>
        </div>



    </div>

    <div class="tab-pane" id="stock">
        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'in_stock',
                    [
                        'widgetOptions' => [
                            'data' => $model->getInStockList(),
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-2">
                <?= $form->numberFieldGroup(
                    $model,
                    'quantity',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'min' => 0,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'length'); ?>
            </div>
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'width'); ?>
            </div>
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'height'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <?= $form->textFieldGroup($model, 'weight'); ?>
            </div>
        </div>

    </div>

    <div class="tab-pane" id="images">
        <?php if ($model->getIsNewRecord()): ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-success">
                        <?= Yii::t("StoreModule.store", "Mass upload alert"); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row form-group">
            <div class="col-xs-2">
                <?= Yii::t("StoreModule.store", "Images"); ?>
            </div>
            <div class="col-xs-2">
                <button id="button-add-image" type="button" class="btn btn-default"><i class="fa fa-fw fa-plus"></i>
                </button>
            </div>
            <div class="col-sm-3 col-sm-offset-5 text-right">
                <button type="button" data-toggle="modal" data-target="#image-groups" class="btn btn-primary">
                    <?= Yii::t("StoreModule.store", "Image groups"); ?>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php $imageModel = new ProductImage(); ?>
                <div id="product-images">
                    <div class="image-template hidden form-group">
                        <div class="row">
                            <div class="col-xs-6 col-sm-2">
                                <label for=""><?= Yii::t("StoreModule.store", "File"); ?></label>
                                <input type="file" class="image-file"/>
                            </div>
                            <div class="col-xs-5 col-sm-3">
                                <label for=""><?= Yii::t("StoreModule.store", "Image title"); ?></label>
                                <input type="text" class="image-title form-control"/>
                            </div>
                            <div class="col-xs-5 col-sm-3">
                                <label for=""><?= Yii::t("StoreModule.store", "Image alt"); ?></label>
                                <input type="text" class="image-alt form-control"/>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <label for=""><?= Yii::t("StoreModule.store", "Group"); ?></label>
                                <?= CHtml::dropDownList('', null, ImageGroupHelper::all(), [
                                    'empty' => Yii::t('StoreModule.store', '--choose--'),
                                    'class' => 'form-control image-group image-group-dropdown',
                                ]) ?>
                            </div>
                            <div class="col-xs-2 col-sm-1" style="padding-top: 24px">
                                <button class="button-delete-image btn btn-default" type="button"><i
                                        class="fa fa-fw fa-trash-o"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!$model->getIsNewRecord() && $model->images): ?>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th><?= Yii::t("StoreModule.store", "Image title"); ?></th>
                            <th><?= Yii::t("StoreModule.store", "Image alt"); ?></th>
                            <th><?= Yii::t("StoreModule.store", "Group"); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model->images as $image): ?>
                            <tr>
                                <td>
                                    <img src="<?= $image->getImageUrl(100, 100); ?>" alt="" class="img-responsive"/>
                                </td>
                                <td>
                                    <?= CHtml::textField('ProductImage['.$image->id.'][title]', $image->title,
                                        ['class' => 'form-control']) ?>
                                </td>
                                <td>
                                    <?= CHtml::textField('ProductImage['.$image->id.'][alt]', $image->alt,
                                        ['class' => 'form-control']) ?>
                                </td>
                                <td>
                                    <?= CHtml::dropDownList(
                                        'ProductImage['.$image->id.'][group_id]',
                                        $image->group_id,
                                        ImageGroupHelper::all(),
                                        [
                                            'empty' => Yii::t('StoreModule.store', '--choose--'),
                                            'class' => 'form-control image-group-dropdown',
                                        ]
                                    ) ?>
                                </td>
                                <td class="text-center">
                                    <a data-id="<?= $image->id; ?>" href="<?= Yii::app()->createUrl(
                                        '/store/productBackend/deleteImage',
                                        ['id' => $image->id]
                                    ); ?>" class="btn btn-default product-delete-image"><i
                                            class="fa fa-fw fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="files">
        <?php if ($model->getIsNewRecord()): ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-success">
                        <?= Yii::t("StoreModule.store", "Mass upload alert"); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row form-group">
            <div class="col-xs-2">
               Файлы
            </div>
            <div class="col-xs-2">
                <button id="button-add-file" type="button" class="btn btn-default"><i class="fa fa-fw fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php $fileModel = new ProductFiles(); ?>
                <div id="product-files">
                    <div class="image-template hidden form-group">
                        <div class="row">
                            <div class="col-xs-6 col-sm-2">
                                <label for=""><?= Yii::t("StoreModule.store", "File"); ?></label>
                                <input type="file" class="image-file"/>
                            </div>
                            <div class="col-xs-5 col-sm-3">
                                <label for=""><?= Yii::t("StoreModule.store", "Image title"); ?></label>
                                <input type="text" class="image-title form-control"/>
                            </div>

                            <div class="col-xs-2 col-sm-1" style="padding-top: 24px">
                                <button class="button-delete-file btn btn-default" type="button"><i
                                        class="fa fa-fw fa-trash-o"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!$model->getIsNewRecord() && $model->files): ?>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th><?= Yii::t("StoreModule.store", "Image title"); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model->files as $file): ?>
                            <tr>
                                <td>
                                   <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </td>
                                <td>
                                    <?= CHtml::textField('ProductFiles['.$file->id.'][title]', $file->title,
                                        ['class' => 'form-control']) ?>
                                </td>
                                 <td>
                                    <?= $file->name?>
                                </td>

                                <td class="text-center">
                                    <a data-id="<?= $file->id; ?>" href="<?= Yii::app()->createUrl(
                                        '/store/productBackend/deleteFile',
                                        ['id' => $file->id]
                                    ); ?>" class="btn btn-default product-delete-file"><i
                                            class="fa fa-fw fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="attributes">
        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'type_id',
                    [
                        'widgetOptions' => [
                            'data' => CHtml::listData(Type::model()->findAll(), 'id', 'name'),
                            'htmlOptions' => [
                                'empty' => '---',
                                'encode' => false,
                                'id' => 'product-type',
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div id="attributes-panel">
            <?php $this->renderPartial(
                '_attribute_form',
                ['groups' => $model->getAttributeGroups(), 'model' => $model]
            ); ?>
        </div>
    </div>

    <div class="tab-pane" id="seo">
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'title'); ?>
            </div>
        </div>
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
<div class="tab-pane" id="photos">
        <div id="photoss">
            <style type="text/css">
                .image-wrapper{
                    width: 200px;
                    border: 1px solid #cecece;
                }
                .image-wrapper .gallery-thumbnail{
                    height: auto;
                }
                .gallery-thumbnail .move-sign{
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                }
                #chain-photos{
                    width:  auto;
                    text-align: center
                }
                .chain-photo{
                    position: relative;
                    display: block;
                    /*float: left;*/
                    margin: 5px;
                    position: relative;
                }
                .chain-photo .form-group label{
                    font-size: 12px;
                }
                .chain-photo__img{
                    position: relative;
                    height: 190px;
                    line-height: 190px;
                    padding: 0 0 10px;
                }
                .chain-photo__img img{
                    max-height: 100%;
                }

                .image-settings .btn{
                    width: 30px;
                    height: 30px;
                    margin: 0;
                    float: none;
                    padding: 0;
                    border-radius: 5px !important;
                }
                .image-settings .row{
                    padding: 5px 0;
                }

                .file-drop-zone{
                    margin-bottom: 5px;
                }

                .file-drop-zone-title{
                    padding: 30px 10px!important;

                }
                .file-preview{
                    margin-bottom: 0;
                    border: none;
                }
                .photo-add-input{
                    width: 100%;
                    text-align: center;
                    border-bottom: 1px solid rgba(0, 0, 0, 0.3);
                    margin: 0 0 40px;
                }
                .photo-add-input label{
                    display: block;
                    text-align: left;
                    padding: 0 0 5px;
                }

                .photo-add-input span{
                    font-size: 20px;
                    opacity: .5;
                    font-weight: 900;
                    position: absolute;
                    top: 5px;
                    right: 5px;
                }
                .photo-add-input .btn-file{
                    /*display: none;*/
                    margin: 15px 0 0;
                }
                .photo-add-input .hidden-xs{
                    font-size: 16px;
                    opacity: .5;
                    font-weight: 900;
                    position: static;
                }
                .photo-add-input .glyphicon-plus-sign:before{
                    display: none!important;
                }
            </style>
           <?php
               Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
               $mainAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('gallery.views.assets'));
                Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/gallery.css');
                Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/gallery-sortable.js', CClientScript::POS_END);

                Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/fileinput.min.css');
                Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/fileinput.min.js', CClientScript::POS_END);

                $this->widget('gallery.extensions.colorbox.ColorBox', [
                    'target' => '.gallery-image',
                    'config' => [ // тут конфиги плагина, подробнее http://www.jacklmoore.com/colorbox
                    ],
                ]);
                Yii::app()->clientScript->registerScript("input", "
                    $('.photo-add-input').find('input').fileinput({
                         showCaption: false,
                         browseLabel: 'Выберите файл',
                         browseClass: 'btns',
                         dropZoneTitle:'Перетащите сюда ваши файлы <br>или',
                         removeLabel: 'Удалить',
                         uploadLabel:'Загрузить',
                         msgZoomModalHeading:'Детальный просмотр',
                         zoomTitle:'Детальный просмотр'
                         });
                ");
                $keys = [];
                ?>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="photo-add-input">
                                <label>Добавить изображения</label>
                                <?php echo CHtml::fileField("ProductPhotos[][image]",'', ['multiple'=>true]); ?><br/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$model->getIsNewRecord()): ?>
                    <div id="gallery-wrapper">
                        <div class="row gallery-thumbnails thumbnails">
                            <?php foreach ($model->photos(['order' => 'position DESC']) as $image): ?>
                                <?php $keys[] = sprintf('<span data-order="%d">%d</span>', $image->position, $image->id); ?>
                                <div class="image-wrapper">
                                    <div class="gallery-thumbnail">
                                        <div class="page-photo">
                                            <div class="page-photo__img">
                                                <div class="move-sign">
                                                    <span class="fa fa-4x fa-arrows"></span>
                                                </div>
                                                <img src="<?= $image->getImageUrl(170, 170); ?>" alt=""/>
                                            </div>
                                            <div class="btn-group image-settings">
                                                <button type="button" class="btn btn-default page-delete-photo" data-id="<?= $image->id; ?>" href="<?= Yii::app()->createUrl('/store/productBackend/deletePhotos', ['id' => $image->id]); ?>"><span class="fa fa-fw fa-times"></span></button>
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="collapse"
                                                        data-target="#image-settings<?= $image->id; ?>"><span class="fa fa-gear"></span></button>
                                                <div id="image-settings<?= $image->id; ?>" class="dropdown-menu">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <?= CHtml::textField('ProductPhotos['.$image->id.'][title]', $image->title,['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <?= CHtml::textField('ProductPhotos['.$image->id.'][alt]', $image->alt,['class' => 'form-control', 'placeholder' => 'Alt']) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <div class="sortOrder hidden"
                data-token-name="<?= Yii::app()->getRequest()->csrfTokenName; ?>"
                data-token="<?= Yii::app()->getRequest()->getCsrfToken(); ?>"
                data-action="<?= Yii::app()->createUrl('/store/categoryBackend/sortablephoto') ?>"
                >
                <?= implode('', $keys) ?>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="variants">
        <div class="row">
            <div class="col-sm-12 form-group">
                <label class="control-label" for=""><?= Yii::t("StoreModule.store", "CAttribute"); ?></label>

                <div class="form-inline">
                    <div class="form-group">
                        <select id="variants-type-attributes" class="form-control"></select>
                        <a href="#" class="btn btn-default" id="add-product-variant"><?= Yii::t(
                                "StoreModule.store",
                                "Add"
                            ); ?></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="variant-template variant">
                        <table>
                            <thead>
                            <tr>
                                <td><?= Yii::t("StoreModule.store", "CAttribute"); ?></td>
                                <td><?= Yii::t("StoreModule.store", "Value"); ?></td>
                                <td><?= Yii::t("StoreModule.store", "Price type"); ?></td>
                                <td><?= Yii::t("StoreModule.store", "Price"); ?></td>
                                <td><?= Yii::t("StoreModule.store", "SKU"); ?></td>
                                <td><?= Yii::t("StoreModule.store", "Quantity"); ?></td>
                                <td><?= Yii::t("StoreModule.store", "Order"); ?></td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody id="product-variants">
                            <?php foreach ((array)$model->variants as $variant): ?>
                                <?php $this->renderPartial('_variant_row', ['variant' => $variant]); ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="linked">
        <?php if ($model->getIsNewRecord()): ?>
            <?= Yii::t("StoreModule.store", "First you need to save the product."); ?>
        <?php else: ?>
            <?= $this->renderPartial('_link_form', ['product' => $model, 'searchModel' => $searchModel]); ?>
        <?php endif; ?>
    </div>
</div>

<br/><br/>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->getIsNewRecord() ? Yii::t('StoreModule.store', 'Add product and continue') : Yii::t(
            'StoreModule.store',
            'Save product and continue'
        ),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->getIsNewRecord() ? Yii::t('StoreModule.store', 'Add product and close') : Yii::t(
            'StoreModule.store',
            'Save product and close'
        ),
    ]
); ?>

<?php $this->endWidget(); ?>

<?php $this->renderPartial('_image_groups_modal', ['imageGroup' => $imageGroup]) ?>

<script type="text/javascript">
    $(function () {

        $('#product-form').submit(function () {
            var productForm = $(this);
            $('#category-tree a.jstree-clicked').each(function (index, element) {
                productForm.append('<input type="hidden" name="categories[]" value="' + $(element).data('category-id') + '" />');
            });
        });

        var typeAttributes = {};

        function updateVariantTypeAttributes() {
            var typeId = $('#product-type').val();
            if (typeId) {
                $.getJSON('<?= Yii::app()->createUrl('/store/productBackend/typeAttributes');?>/' + typeId, function (data) {
                    typeAttributes = data;
                    var select = $('#variants-type-attributes');
                    select.html("");
                    $.each(data, function (key, value) {
                        select.append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.title));
                    });
                });
            }
        }
        updateVariantTypeAttributes();

        $("#add-product-variant").click(function (e) {
            e.preventDefault();
            var attributeId = $('#variants-type-attributes').val();
            var variantAttribute = typeAttributes.filter(function (el) {
                return el.id == attributeId;
            }).pop();
            var tbody = $('#product-variants');
            $.get('<?= Yii::app()->createUrl('/store/productBackend/variantRow');?>/' + attributeId, function (data) {
                tbody.append(data);
            });
        });

        $('#product-variants').on('click', '.remove-variant', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });

        $('#product-type').on('change', function () {
            var typeId = $(this).val();
            if (typeId) {
                $('#attributes-panel').load('<?= Yii::app()->createUrl('/store/productBackend/typeAttributesForm');?>/' + typeId);
                updateVariantTypeAttributes();
            }
            else {
                $('#attributes-panel').html('');
                $('#variants-type-attributes').html('');
            }
        });

        $('#button-add-image').on('click', function () {
            var newImage = $("#product-images .image-template").clone().removeClass('image-template').removeClass('hidden');
            var key = $.now();

            newImage.appendTo("#product-images");
            newImage.find(".image-file").attr('name', 'ProductImage[new_' + key + '][name]');
            newImage.find(".image-title").attr('name', 'ProductImage[new_' + key + '][title]');
            newImage.find(".image-alt").attr('name', 'ProductImage[new_' + key + '][alt]');
            newImage.find(".image-group").attr('name', 'ProductImage[new_' + key + '][group_id]');

            return false;
        });

        $(this).closest('.product-image').remove();

        $('#product-images').on('click', '.button-delete-image', function () {
            $(this).closest('.row').remove();
        });
        $('#product-files').on('click', '.button-delete-file', function () {
            $(this).closest('.row').remove();
        });

        $('.product-delete-image').on('click', function (event) {
            event.preventDefault();
            var blockForDelete = $(this).closest('tr');
            $.ajax({
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                },
                url: '<?= Yii::app()->createUrl('/store/productBackend/deleteImage');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });
        $('.product-delete-file').on('click', function (event) {
            event.preventDefault();
            var blockForDelete = $(this).closest('tr');
            $.ajax({
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                },
                url: '<?= Yii::app()->createUrl('/store/productBackend/deleteFile');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });

        // fffff
    $('#button-add-file').on('click', function () {
            var newImage = $("#product-files .image-template").clone().removeClass('image-template').removeClass('hidden');
            var key = $.now();

            newImage.appendTo("#product-files");
            newImage.find(".image-file").attr('name', 'ProductFiles[new_' + key + '][name]');
            newImage.find(".image-title").attr('name', 'ProductFiles[new_' + key + '][title]');

            return false;
        });

        function activateFirstTabWithErrors() {
            var tab = $('.has-error').parents('.tab-pane').first();
            if (tab.length) {
                var id = tab.attr('id');
                $('a[href="#' + id + '"]').tab('show');
            }
        }

        activateFirstTabWithErrors();
    });
</script>
<script type="text/javascript">
    $(function () {
        $('.page-delete-photo').on('click', function (event) {
            event.preventDefault();
            var blockForDelete = $(this).closest('.image-wrapper');
            $.ajax({
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                },
                url: '<?= Yii::app()->createUrl('/store/productBackend/deletePhotos');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });
    });
    $(this).closest('.page-image').remove();
    $('#page-images').on('click', '.button-delete-image', function () {
        $(this).closest('.row').remove();
    });
</script>
