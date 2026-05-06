<?php

use yupe\models\YModel;
/**
 * This is the model class for table "{{customfield_group}}".
 *
 * The followings are the available columns in table '{{customfield_group}}':
 * @property integer $id
 * @property string $name
 */
class CustomfieldGroup extends YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{customfield_group}}';
	}

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'filter', 'filter' => 'trim'],
            ['name, module_id', 'length', 'max' => 255],
            ['id, name, module_id', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('YupeModule.yupe', 'ID'),
            'name' => Yii::t('YupeModule.yupe', 'Название'),
        ];
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('module_id', $this->module_id);

        return new CActiveDataProvider(
            $this, [
                'criteria' => $criteria,
                'sort' => ['defaultOrder' => 'id'],
            ]
        );
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomfieldGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getGroupDataProviderList($module_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('module_id', $module_id);

        return new CActiveDataProvider(
            $this, [
                'criteria' => $criteria,
                'sort' => ['defaultOrder' => 'id'],
            ]
        );
    }

    public function getGroupList($module_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('module_id', $module_id);

        return CHtml::listData(self::model()->findAll($criteria), 'id', 'name');
    }
}
