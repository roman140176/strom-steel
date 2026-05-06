<?php
/**
* Класс CustomfieldGroupBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://yupe.ru
**/
class CustomfieldGroupBackendController extends \yupe\components\controllers\BackController
{
    public function filters()
    {
        return CMap::mergeArray(
            parent::filters(),
            [
                'ajaxOnly + index, data',
                'postOnly + create, delete',
            ]
        );
    }
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'CustomfieldGroup',
                'validAttributes' => ['name'],
            ],
        ];
    }

    public function actionIndex($module)
    {
        $this->renderPartial('/customfieldGroupBackend/groups_grid', [
            'customfieldGroup' => CustomfieldGroup::model(), 
            'module' => $module
        ]);
    }

    public function actionCreate()
    {
        $model = new CustomfieldGroup();

        $data = Yii::app()->getRequest()->getPost('CustomfieldGroup');
        if ($data) {
            $model->setAttributes($data);

            if ($model->save()) {
                Yii::app()->ajax->success(Yii::t('YupeModule.yupe', 'The group is successfully created'));
            }
        }

        Yii::app()->ajax->error(Yii::t('YupeModule.yupe', 'Failed to create group'));
    }

    public function actionDelete($id)
    {
        if (CustomfieldGroup::model()->findByPk($id)->delete()) {
            Yii::app()->ajax->success(Yii::t('YupeModule.yupe', 'The group is successfully deleted'));
        }

        Yii::app()->ajax->error(Yii::t('YupeModule.yupe', 'Failed to delete group'));
    }

    public function actionData()
    {
        Yii::app()->ajax->success(CHtml::listData(CustomfieldGroup::model()->findAll(), 'id', 'name'));
    }
}
