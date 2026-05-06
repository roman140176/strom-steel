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