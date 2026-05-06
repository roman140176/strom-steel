<style type="text/css">
    .CodeMirror-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 9999;
        height: 100% !important;
    }
</style>
<?php
    $assets = Yii::app()->getAssetManager()->publish(
        Yii::getPathOfAlias('vendor').'/codemirror/codemirror/'
    );

    Yii::app()->getClientScript()->registerCssFile($assets . '/lib/codemirror.css');
    Yii::app()->getClientScript()->registerCssFile($assets . '/theme/monokai.css');

    Yii::app()->getClientScript()->registerScriptFile($assets . '/lib/codemirror.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/xml/xml.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/php/php.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/javascript/javascript.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/css/css.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/htmlmixed/htmlmixed.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/addon/edit/matchbrackets.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/addon/search/search.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/addon/search/searchcursor.js');
    // Yii::app()->getClientScript()->registerScriptFile($assets . '/addon/display/fullscreen.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/emmet/emmet.js');
    Yii::app()->getClientScript()->registerScriptFile($assets . '/keymap/sublime.js');

    Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
    $mainAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('gallery.views.assets'));
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/gallery.css');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/gallery-sortable.js', CClientScript::POS_END);

    $assetsfm = Yii::app()->getAssetManager()->publish(
        Yii::getPathOfAlias('application.modules.yupe.views.assets.css')
    );
    Yii::app()->getClientScript()->registerCssFile($assetsfm . '/photos.css');

    $keysFieldPhoto = [];
?>

<?php
    $customfieldGroup = CustomfieldGroup::model();
    $module = Yii::app()->controller->module->id;
    $groupList = $customfieldGroup->getGroupList($module)
?>

<div class="row form-group">
    <div class="col-sm-8">
        <label>Произвольное поле: </label>
        <button id="button-add-myfield" type="button" class="btn btn-default">
            <i class="fa fa-fw fa-plus"></i>
        </button>
    </div>
    <div class="col-sm-4 text-right">
        <button type="button" data-toggle="modal" data-target="#customfield-groups" class="btn btn-primary">
            <?= Yii::t("YupeModule.yupe", "Группы"); ?>
        </button>
    </div>
</div>

<div class="row js-myfield-row" data-key="<?= (!empty($model->data) ? count($model->data) : 0); ?>">
    <div class="col-xs-12">
        <div id="myfield-section">
            <div class="myfield-template hidden form-group js-myfield">
                <div class="row">
                    <input type="hidden" class="myfield-position form-control"/>
                    <div class="col-sm-4">
                        <label for="">Название</label>
                        <input type="text" class="myfield-name form-control"/>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Code</label>
                        <input type="text" class="myfield-code form-control"/>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Группа</label>
                        <?= CHtml::dropDownList('', '', $groupList,
                            [
                                'empty' => '--выберите группу--',
                                'class' => 'form-control myfield-group-dropdown',
                            ]
                        ) ?>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Выберите редактор</label>
                        <?= CHtml::dropDownList('', '', [
                                'CodeMirror' => 'Обычное поле',
                                'Redactor' => 'Редактор',
                            ],
                            [
                                'class' => 'form-control myfield-template-dropdown js-template-dropdown',
                            ]
                        ) ?>
                    </div>

                    <div class="col-xs-11 col-sm-11">
                        <label for="">Значение</label>
                        <div class="js-template-field">
                            <textarea class="myfield-value form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1" style="padding-top: 24px">
                        <button class="button-delete-field btn btn-default" type="button">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">Название кнопки</label>
                        <input type="text" class="myfield-butName form-control"/>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Ссылка на кнопку</label>
                        <input type="text" class="myfield-butLink form-control"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Изображение</label>
                            <input type="file" class="myfield-image form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Добавить галерею</label>
                            <input multiple="multiple" type="file" class="myfield-gallery form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($model->data): ?>
            <div class="panel-group">
                <div class="panel panel-default panel-field-wrapper" style="border: none;background-color: transparent;">
                    <?php
                        $groupData = [];
                        foreach($model->data as $i) {
                            $groupId = $i['group'];
                            if(!empty($groupId)){
                                if(array_key_exists($groupId, $groupList)){
                                    $groupData['Группа - ' . $groupList[$groupId]][] = $i;
                                } else {
                                    $groupData['Id группы = '. $groupId.' (удалена)'][] = $i;
                                }
                            } else {
                                $groupData['Без группы'][] = $i;
                            }
                        }
                    ?>
                <?php $key = 0; ?>
                <?php $ind = 0; ?>
                <?php foreach ($groupData as $nameGroup => $group): ?>
                    <?php $ind++; ?>
                    <?php $keysField[$ind] = []; ?>
                    <div class="group-wrapper">
                        <div class="groupTitle"><?= $nameGroup; ?></div>
                        <div class="group-wrapper-<?= $ind?>">
                            <?php //foreach ($model->data as $key=>$data): ?>
                            <?php foreach ($group as $index => $data): ?>
                                <?php $key++; ?>
                                <?php $keysField[$ind][] = sprintf('<span data-order="%d">%d</span>', $key, $key); ?>
                                <div class="js-myfield" data-key="<?= $key; ?>" data-poskey="<?= $key; ?>" data-group="<?= $data['group']?>">
                                    <?= CHtml::hiddenField('MyCustomField['.$key.'][position]', $key); ?>
                                    <div class="panel-heading" style="background: #fff; margin: 0 0 10px; border: 1px solid #ccc">
                                        <div class="panel-title">
                                            <a class="" data-toggle="collapse" href="#customfieldcollapse<?= $key; ?>">
                                                <h5 style="display: flex; justify-content: space-between; font-size: 16px; padding: 0 10px;">
                                                    <strong><?= $data['name']; ?></strong>
                                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="customfieldcollapse<?= $key; ?>" class="panel-collapse collapse js-collapse-open">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="">Название</label>
                                                        <?= CHtml::textField('MyCustomField['.$key.'][name]', $data['name'],
                                                            ['class' => 'form-control']) ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">
                                                            <?= (int)$data['group'] == 11 ? 'Дата экзамена' : 'Code'?>

                                                        </label>
                                                        <?= CHtml::textField('MyCustomField['.$key.'][code]', $data['code'], [
                                                                'class' => 'form-control',
                                                                // 'disabled' => true
                                                        ]) ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Выберите группу</label>
                                                        <?= CHtml::dropDownList('MyCustomField['.$key.'][group]', $data['group'], $groupList,
                                                            [
                                                                'empty' => '--выберите группу--',
                                                                'class' => 'form-control myfield-group-dropdown',
                                                                'data-key' => $key
                                                            ]
                                                        ) ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Выберите редактор</label>
                                                        <?= CHtml::dropDownList('MyCustomField['.$key.'][template]', $data['template'], [
                                                                'CodeMirror' => 'Обычное поле',
                                                                'Redactor' => 'Редактор',
                                                            ],
                                                            [
                                                                'class' => 'form-control myfield-template-dropdown js-template-dropdown',
                                                                'data-key' => $key
                                                            ]
                                                        ) ?>
                                                    </div>
                                                    <div class="col-xs-11 col-sm-11">
                                                        <label for="">Значение</label>
                                                        <div class="js-template-field">
                                                            <?php if($data['template'] == 'Redactor') : ?>
                                                                <?php $this->widget( $this->yupe->getVisualEditor(),[
                                                                    'name' => 'MyCustomField['.$key.'][value]',
                                                                    'value' => $data['value']
                                                                ]); ?>
                                                            <?php else : ?>
                                                                <?= CHtml::textArea('MyCustomField['.$key.'][value]', $data['value'], [
                                                                    'class' => 'form-control mytextareaVal'
                                                                ]) ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-1 col-sm-1" style="padding-top: 24px">
                                                        <button class="btn btn-danger button-delete-myfield">
                                                            <i class="fa fa-fw fa-trash-o"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div><br></div>
                                                <div class='row'>
                                                    <div class="col-sm-4">
                                                        <?php
                                                        $label = 'Название кнопки';
                                                        $label2 = 'Ссылка на кнопку';
                                                        switch ((int)$data['group']) {
                                                            case 'value':
                                                               case 11:
                                                               $label  = 'Время экзамена';
                                                               $label2  = 'Адрес';
                                                                break;
                                                        } ?>
                                                        <label for="">
                                                            <?= $label?>
                                                        </label>
                                                        <?= CHtml::textField('MyCustomField['.$key.'][butName]', $data['butName'],
                                                            ['class' => 'form-control']) ?>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">
                                                            <?= $label2?>
                                                        </label>
                                                        <?= CHtml::textField('MyCustomField['.$key.'][butLink]', $data['butLink'],
                                                            ['class' => 'form-control']) ?>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class="col-sm-12">
                                                        <br>
                                                        <?php if(!empty($data['image'])) : ?>
                                                            <?= CHtml::hiddenField('MyCustomField['.$key.'][image]', $data['image']) ?>
                                                            <?php
                                                            echo CHtml::image($model->getFieldImageUrl(200,200,false,$data['image']),
                                                            '',
                                                                [
                                                                    'class' => 'preview-image',
                                                                    ]
                                                                ); ?>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="myCustomField-delete-image-<?= $key;?>"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                                                                </label>
                                                            </div>
                                                        <?php endif; ?>
                                                        <label>Изображение</label>
                                                        <input type="file" class="form-control" name="MyCustomField_<?= $key; ?>[image]">
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class="col-sm-12">
                                                        <label>Добавить галерею</label>
                                                        <input type="file" multiple="multiple" class="form-control" name="MyCustomFieldGallery_<?= $key; ?>[]">
                                                        <br>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <?php if(!empty($data['gallery'])) : ?>
                                                            <div id="galleryField-wrapper">
                                                                <div class="row galleryField-thumbnails thumbnails">
                                                                    <?php foreach ($data['gallery'] as $key2 => $images) :?>
                                                                        <?php $keysFieldPhoto[] = sprintf('<span data-order="%d">%d</span>', $key2+1, $key.$key2); ?>
                                                                        <div class="col-md-3 col-sm-4 col-xs-6 imageField-wrapper image-wrapper" data-pos="<?= $key.$key2; ?>">
                                                                            <div class="gallery-thumbnail">
                                                                                <?= CHtml::hiddenField('MyCustomField['.$key.'][gallery]['.$key2.'][image]', $images['image']) ?>
                                                                                <?= CHtml::hiddenField('MyCustomField['.$key.'][gallery]['.$key2.'][position]', $images['position'], ['class' => 'js-customField-pos-images']) ?>
                                                                                <div class="hidden">
                                                                                    <input type="checkbox" name="myCustomField-delete-galImage-<?= $key.'_'.$key2;?>"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                                                                                </div>
                                                                                <div class="field-photo">
                                                                                    <div class="field-photo__img">
                                                                                        <div class="move-sign">
                                                                                            <span class="fa fa-4x fa-arrows"></span>
                                                                                        </div>
                                                                                        <?php if(!empty($images['image']))  : ?>
                                                                                            <?php if(!empty($model->getFieldGalImageUrl(170,170,false,$images['image']))) : ?>
                                                                                                <?= CHtml::image($model->getFieldGalImageUrl(170,170,false,$images['image']), '', ['class' => 'preview-image']); ?>
                                                                                            <?php endif; ?>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                    <div class="btn-group image-settings">
                                                                                        <button type="button" class="btn btn-default js-customfield-delete-img" data-id="<?= $image->id; ?>"><span class="fa fa-fw fa-times"></span></button>
                                                                                        <button type="button"
                                                                                            class="btn btn-default"
                                                                                            data-toggle="modal"
                                                                                            data-backdrop="false"
                                                                                            data-target="#image-settings<?= $key.'-'.$key2; ?>">
                                                                                                <span class="fa fa-gear"></span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="image-settings<?= $key.'-'.$key2; ?>" class="modal modal-my modal-my-xs fade" role="dialog">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="container-fluid">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-4">
                                                                                                        <div class="modal-preview-image">
                                                                                                            <?php if(!empty($images['image']))  : ?>
                                                                                                                <?php if(!empty($model->getFieldGalImageUrl(230,230,false,$images['image']))) : ?>
                                                                                                                    <?= CHtml::image($model->getFieldGalImageUrl(230,230,false,$images['image']), '', ['class' => 'preview-image']); ?>
                                                                                                                <?php endif; ?>
                                                                                                            <?php endif; ?>
                                                                                                        </div>
                                                                                                        <br>
                                                                                                        <input type="file" class="form-control" name="MyCustomFieldGalleryImage_<?= $key; ?>_<?= $key2; ?>[]">
                                                                                                    </div>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="row">
                                                                                                            <div class="col-xs-12">
                                                                                                                <div class="form-group">
                                                                                                                    <?= CHtml::textField('MyCustomField['.$key.'][gallery]['.$key2.'][color]', $images['color'],['class' => 'form-control', 'placeholder' => 'Цвет']) ?>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-xs-12">
                                                                                                                <div class="form-group">
                                                                                                                    <?= CHtml::textField('MyCustomField['.$key.'][gallery]['.$key2.'][title]', $images['title'],['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-xs-12">
                                                                                                                <div class="form-group">
                                                                                                                    <?= CHtml::textField('MyCustomField['.$key.'][gallery]['.$key2.'][alt]', $images['alt'],['class' => 'form-control', 'placeholder' => 'Alt']) ?>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-xs-12">
                                                                                                                <div class="form-group">
                                                                                                                    <?= CHtml::textArea('MyCustomField['.$key.'][gallery]['.$key2.'][desc]', $images['desc'],['class' => 'form-control', 'placeholder' => 'Описание']) ?>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Закрыть</button>
                                                                                            <button type="submit" class="btn btn-primary">Сохранить и обновить</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="sortOrderFieldPanel<?= $ind; ?> hidden"
                        data-token-name="<?= Yii::app()->getRequest()->csrfTokenName; ?>"
                        data-token="<?= Yii::app()->getRequest()->getCsrfToken(); ?>"
                        data-action="<?= Yii::app()->createUrl('/directions/directionsBackend/sortablefield') ?>"
                        >
                        <?= implode('', $keysField[$ind]) ?>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var originalPosFieldPanel = null;
                            var dataFiledPanel = {};
                            var keysElFieldPanel = $(".sortOrderFieldPanel<?= $ind; ?>");
                            dataFiledPanel[keysElFieldPanel.data('token-name')] = keysElFieldPanel.data('token');

                            var sortableHelperField = function (a, el) {
                                originalPosFieldPanel = el.prevAll().length;
                                var helper = el.clone();
                                return helper;
                            };

                            $('.group-wrapper-<?= $ind; ?>').sortable({
                                helper: sortableHelperField,
                                update: function (event, ui) {
                                    var pos = $(ui.item).prevAll().length;
                                    if (originalPosFieldPanel !== null && originalPosFieldPanel != pos) {
                                        var keys = keysElFieldPanel.children('span');
                                        var key = keys.eq(originalPosFieldPanel);
                                        var sort = [];

                                        keys.each(function (i) {
                                            sort[i] = $(this).attr('data-order');
                                        });

                                        if (originalPosFieldPanel < pos) {
                                            keys.eq(pos).after(key);
                                        }
                                        if (originalPosFieldPanel > pos) {
                                            keys.eq(pos).before(key);
                                        }
                                        originalPosFieldPanel = null;
                                    }
                                    var sortOrder = {};
                                    keys = keysElFieldPanel.children('span');
                                    keys.each(function (i) {
                                        $(this).attr('data-order', sort[i]);
                                        sortOrder[$(this).text()] = sort[i];
                                    });

                                    dataFiledPanel["sortOrder"] = sortOrder;
                                    for(var it in sortOrder) {
                                        var value = sortOrder[it];
                                        var block = $('.js-myfield[data-key='+it+']');
                                        $('.js-myfield[data-poskey='+it+']').attr('data-key', value);
                                        $('#MyCustomField_'+it+'_position').val(value);
                                    }

                                    /*$.ajax({
                                        type: "POST",
                                        url: keysElField.data('action'),
                                        data: dataFiled
                                    });*/
                                }
                            });

                                $('.js-template-field').on( "mousemove", function(e){
                                    e.stopPropagation();
                            })
                        });
                    </script>
                <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="sortOrderField hidden"
            data-token-name="<?= Yii::app()->getRequest()->csrfTokenName; ?>"
            data-token="<?= Yii::app()->getRequest()->getCsrfToken(); ?>"
            data-action="<?= Yii::app()->createUrl('/directions/directionsBackend/sortablephoto') ?>"
            >
            <?= implode('', $keysFieldPhoto) ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*
     * Создаем новое произвольное поле
    */
    $(document).delegate('#button-add-myfield', 'click', function () {
        var newfield = $("#myfield-section .myfield-template").clone().removeClass('myfield-template').removeClass('hidden');
        // var key = $.now();
        // var key = $(".js-myfield-row").find('.js-myfield').length;
        var key = updatePositionCustomField();
        key = parseInt(key) + 1;

        newfield.prependTo("#myfield-section");
        newfield.find(".myfield-position").attr('name', 'MyCustomField[' + key + '][position]');
        newfield.find(".myfield-position").val(key);
        newfield.find(".myfield-name").attr('name', 'MyCustomField[' + key + '][name]');
        newfield.find(".myfield-code").attr('name', 'MyCustomField[' + key + '][code]');
        newfield.find(".myfield-value").attr('name', 'MyCustomField[' + key + '][value]');
        newfield.find(".myfield-value").attr('id', 'MyCustomField_' + key + '_value');
        newfield.find(".myfield-butName").attr('name', 'MyCustomField[' + key + '][butName]');
        newfield.find(".myfield-butLink").attr('name', 'MyCustomField[' + key + '][butLink]');
        newfield.find(".myfield-template-dropdown").attr('name', 'MyCustomField[' + key + '][template]');
        newfield.find(".myfield-group-dropdown").attr('name', 'MyCustomField[' + key + '][group]');
        newfield.find(".myfield-image").attr('name', 'MyCustomField_' + key + '[image]');
        newfield.find(".myfield-gallery").attr('name', 'MyCustomFieldGallery_' + key + '[]');

        updateCodemirror(newfield.find(".myfield-value")[0], 250);

        newfield.attr('data-key', key);
        $(".js-myfield-row").attr('data-key', key);
        return false;
    });
    /*
     * Удаляем не сохраненное произвольное поле
    */
    $('#myfield-section').on('click', '.button-delete-field', function () {
        $(this).closest('.js-myfield').remove();
        var key = updatePositionCustomField();
        key = parseInt(key) - 1;
        $(".js-myfield-row").attr('data-key', key);
    });
    /*
     * Удаляем сохраненное произвольное поле и обновляем сортировку
    */
    $('.button-delete-myfield').on('click', function () {
        var a = confirm("Вы действительно хотите удалить файл?");
        if (a) {
            $(this).parents('.js-myfield').remove();

            var key = updatePositionCustomField();
            key = parseInt(key) - 1;
            $(".js-myfield-row").attr('data-key', key);
        }

        return false;
    });

    /*
     * Инициализируем все Codemirror во вкладке
    */
    $('.nav-tabs a').on('shown.bs.tab', function() {
        refreshCodemirror($($(this).attr('href')));
    });
    $('.js-collapse-open').on('shown.bs.collapse', function() {
        refreshCodemirror($(this));
    });
    /*
     * Инициализируем Codemirror при загрузке страницы
    */
    $('.mytextareaVal').each(function(){
        updateCodemirror($(this)[0]);
    });

    /*
     * Меняем шаблон значения(value)
    */
    $(document).delegate('.js-template-dropdown', 'change', function (event) {
        event.preventDefault();
        var parent = $(this).parents('.js-myfield').find('.js-template-field');
        var template = $(this).find('option:selected').val();

        if(template == 'CodeMirror'){
            parent.html(parent.find("textarea")[0]);
            updateCodemirror(parent.find("textarea")[0], 250);
        } else {
            var iid = $(parent.find("textarea")[0]).attr('id');
            const mceElf = new tinymceElfinder({
                url: '/backend/ElFinderConnection',
                lang : 'ru',
                commands : [
                    'archive', 'back', 'chmod', 'colwidth', 'copy', 'cut', 'download', 'duplicate', 'edit', 'extract',
                    'forward', 'fullscreen', 'getfile', 'help', 'home', 'info', 'mkdir', 'mkfile', 'netmount', 'netunmount',
                    'open', 'opendir', 'paste', 'places', 'quicklook', 'reload', 'rename', 'resize', 'restore', 'rm',
                    'search', 'sort', 'up', 'upload', 'view', 'zipdl'
                ],
            });
            tinymce.init({'selector':'#'+iid,'language':'ru','height':'480','plugins':'code\x20importcss\x20searchreplace\x20autolink\x20directionality\x20visualblocks\x20visualchars\x20fullscreen\x20image\x20link\x20media\x20template\x20codesample\x20table\x20charmap\x20hr\x20pagebreak\x20nonbreaking\x20anchor\x20toc\x20insertdatetime\x20advlist\x20lists\x20wordcount\x20imagetools\x20textpattern\x20noneditable\x20help\x20charmap\x20quickbars\x20emoticons\x20paste','menubar':'','toolbar':'code\x20undo\x20redo\x20\x7C\x20bold\x20italic\x20underline\x20strikethrough\x20\x7C\x20fontselect\x20fontsizeselect\x20formatselect\x20\x7C\x20alignleft\x20aligncenter\x20alignright\x20alignjustify\x20\x7C\x20outdent\x20indent\x20\x7C\x20\x20numlist\x20bullist\x20checklist\x20\x7C\x20forecolor\x20backcolor\x20casechange\x20permanentpen\x20formatpainter\x20removeformat\x20\x7C\x20pagebreak\x20\x7C\x20charmap\x20emoticons\x20\x7C\x20fullscreen\x20\x20preview\x20save\x20print\x20\x7C\x20insertfile\x20image\x20media\x20pageembed\x20template\x20link\x20anchor\x20codesample\x20\x7C\x20a11ycheck\x20ltr\x20rtl\x20\x7C\x20showcomments\x20addcomment','images_upload_handler':function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/backend/AjaxUploadTinyMCE5');

                xhr.onload = function() {
                  var json;

                  if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                  }

                  json = JSON.parse(xhr.responseText);

                  if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                  }

                  success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('YUPE_TOKEN', yupeToken);

                xhr.send(formData);
            },'relative_urls':false,'remove_script_host':true,'convert_urls':true,'allow_script_urls':true,'file_picker_callback':mceElf.browser});
            parent.find('.CodeMirror').remove();
        }
    });

    /*
     * Функция обновления key нового шаблона
    */
    function updatePositionCustomField(){
        var key = 0;
        $('.js-myfield').each(function(){
            var fieldkey = $(this).data('key');
            if(key < parseInt(fieldkey)){
                key = parseInt(fieldkey);
            }
        });
        return key;
    }
    /*
     * Функция инициализации Codemirror
    */
    function updateCodemirror(elem,height=300){
        function isFullScreen(cm) {
            return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
        }
        function winHeight() {
            return window.innerHeight || (document.documentElement || document.body).clientHeight;
        }
        function setFullScreen(cm, full) {
            var wrap = cm.getWrapperElement(), scroll = cm.getScrollerElement();
            if (full) {
                wrap.className += " CodeMirror-fullscreen";
                scroll.style.height = winHeight() + "px";
                document.documentElement.style.overflow = "hidden";
            } else {
                wrap.className = wrap.className.replace(" CodeMirror-fullscreen", "");
                scroll.style.height = "";
                document.documentElement.style.overflow = "";
            }
            cm.refresh();
        }

        var editorVal = CodeMirror.fromTextArea(elem, {
            lineNumbers: true,
            lineWrapping: true,
            mode: 'text/html',
            keyMap: 'sublime',
            theme: 'monokai',
            matchBrackets: true,
            extraKeys: {
                "F11": function(cm) {
                setFullScreen(cm, !isFullScreen(cm));
                },
                "Esc": function(cm) {
                if (isFullScreen(cm)) setFullScreen(cm, false);
                }
            }
        });
        editorVal.setSize(null, height);
        emmetCodeMirror(editorVal);
    }
    /*
     * Функция обновления Codemirror
    */
    function refreshCodemirror(elem) {
        elem.find(".CodeMirror").each(function(){
            var codeMirrorContainer = $(this)[0];
            if (codeMirrorContainer && codeMirrorContainer.CodeMirror) {
                codeMirrorContainer.CodeMirror.refresh();
            }
        });
    }

    $(document).delegate('.js-customfield-delete-img', 'click', function (event) {
        var parent  = $(this).parents('.imageField-wrapper');
        parent.find('input[type=checkbox]').prop('checked', true);
        parent.addClass('hidden');

        return false;
    });

    $(document).ready(function () {
        var originalPosField = null;
        var dataFiled = {};
        var keysElField = $('.sortOrderFieldPhoto');
        dataFiled[keysElField.data('token-name')] = keysElField.data('token');

        var sortableHelperField = function (a, el) {
            originalPosField = el.prevAll().length;
            var helper = el.clone();

            return helper;
        };

        $('.galleryField-thumbnails').sortable({
            helper: sortableHelperField,
            update: function (event, ui) {
                var pos = $(ui.item).prevAll().length;

                if (originalPosField !== null && originalPosField != pos) {
                    var keys = keysElField.children('span');
                    var key = keys.eq(originalPosField);
                    var sort = [];

                    keys.each(function (i) {
                        sort[i] = $(this).attr('data-order');
                    });

                    if (originalPosField < pos) {
                        keys.eq(pos).after(key);
                    }
                    if (originalPosField > pos) {
                        keys.eq(pos).before(key);
                    }
                    originalPosField = null;
                }
                var sortOrder = {};
                keys = keysElField.children('span');
                keys.each(function (i) {
                    $(this).attr('data-order', sort[i]);
                    sortOrder[$(this).text()] = sort[i];
                });

                dataFiled["sortOrder"] = sortOrder;
                console.log(dataFiled["sortOrder"]);
                for(var it in sortOrder) {
                    var value = sortOrder[it];
                    var block = $('.imageField-wrapper[data-pos='+it+']');
                    // var block_val = block.find('.js-customField-pos-images').val();

                    block.find('.js-customField-pos-images').val(value);
                }

                /*$.ajax({
                    type: "POST",
                    url: keysElField.data('action'),
                    data: dataFiled
                });*/
            }
        });
    });
</script>

<div class="modal fade" id="customfield-groups" tabindex="-1" role="dialog" aria-labelledby="customfield-groups-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="customfield-groups-label"><?= Yii::t("YupeModule.yupe", "Группы произвольных полей"); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-9">
                        <input class="js-customfieldGroup-name form-control" type="text" name="CustomfieldGroup[name]">
                        <input class="js-customfieldGroup-module form-control" type="hidden" name="CustomfieldGroup[module]" value="<?= $module; ?>">
                    </div>
                    <div class="col-xs-3">
                        <a class="btn btn-success js-group-add" href="<?= Yii::app()->createUrl('/yupe/customfieldGroupBackend/create'); ?>">
                            <?= Yii::t("YupeModule.yupe", "Добавить"); ?>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                    <?php $this->widget(
                        'yupe\widgets\CustomGridView',
                        [
                            'id' => 'group-grid',
                            'type' => 'condensed striped',
                            'ajaxUrl' => Yii::app()->createUrl('/yupe/customfieldGroupBackend/index', ['module' => $module]),
                            'afterAjaxUpdate' => 'js:updateGroupDropdown',
                            'dataProvider' => $customfieldGroup->getGroupDataProviderList($module),
                            'hideBulkActions' => true,
                            'template' => '{items} {pager}',
                            'pagerCssClass' => 'group-pager',
                            'enableHistory' => false,
                            'columns' => [
                                [
                                    'class' => 'CCheckBoxColumn',
                                    'visible' => false,
                                ],
                                'id',
                                [
                                    'class' => 'bootstrap.widgets.TbEditableColumn',
                                    'name' => 'name',
                                    'editable' => [
                                        'url' => $this->createUrl('/yupe/customfieldGroupBackend/inline'),
                                        'mode' => 'inline',
                                        'params' => [
                                            Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken,
                                        ],
                                    ],
                                    'filter' => CHtml::activeTextField($customfieldGroup, 'name', ['class' => 'form-control']),
                                ],
                                [
                                    'class' => 'yupe\widgets\CustomButtonColumn',
                                    'template' => '{delete}',
                                    'deleteButtonUrl' => function($data){
                                        return Yii::app()->createUrl('/yupe/customfieldGroupBackend/delete', ['id' => $data->id]);
                                    },
                                ]
                            ],
                        ]
                    );
                    ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <?= Yii::t("YupeModule.yupe", "Закрыть"); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).delegate('.js-group-add', 'click', function (event) {
        var name = $('.js-customfieldGroup-name').val();
        var module = $('.js-customfieldGroup-module').val();
        var data = {
            'CustomfieldGroup[name]': name,
            'CustomfieldGroup[module_id]': module,
            'YUPE_TOKEN': yupeToken
        };
        $.ajax({
            type: 'POST',
            url: $(this).attr('href'),
            data: data,
            success: function (response) {
                if (response.result) {
                    $.fn.yiiGridView.update('group-grid');
                }
            },
            error: function (response) {
                console.log(response);
            }

        });
        return false;
    });

    function updateGroupDropdown(){
        $.ajax({
            url: '<?= Yii::app()->createUrl('/yupe/customfieldGroupBackend/data'); ?>',
            success: function (response) {
                if (!response.result) {
                    return false;
                }

                var options = '<option><?= Yii::t('YupeModule.yupe', '--choose--') ?></option>';

                $.each(response.data, function (i, item) {
                    options += '<option value="' + i + '">' + item + '</option>';
                });

                $('.myfield-group-dropdown').each(function(){
                    var selected = $(this).val();

                    $(this).html(options);

                    if (selected && $(this).find('option[value="' + selected + '"]').val() !== undefined) {
                        $(this).val(selected);
                    }
                });
            }
        });
    }
    /*var groups = [];
    $('.js-myfield').each(function(){
        var group = $(this).data('group')
        groups.push(group);
    });

    groups.shift();
    groups = groups.filter(function(i,e,groups){
        return groups.indexOf(i) === e;
    });
    for(i=0;i<groups.length;i++){
        var div = $('<div>',{
            class:'group-wrapper grop' + groups[i]
        });
        $('[data-group="'+groups[i]+'"]').wrapAll(div);
    }
    var groupName = [];
    $('.group-wrapper').each(function(i,e){
        var name = $(this).find('.myfield-group-dropdown').find(':selected')[0];
        groupName.push($(name).text());
        if(groupName[i] != '--выберите группу--'){
            $(this).prepend('<div class="groupTitle">Группа - '+groupName[i]+'</div>');
        }
    });*/
</script>