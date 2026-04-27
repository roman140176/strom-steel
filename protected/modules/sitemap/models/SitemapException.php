<?php

/**
 * This is the model class for table "{{sitemap_exception}}".
 *
 * The followings are the available columns in table '{{sitemap_exception}}':
 * @property integer $id
 * @property string $exception_url
 * @property integer $status
 */
class SitemapException extends yupe\models\YModel
{
	/**
     *
     */
    const STATUS_ACTIVE = 1;
    /**
     *
     */
    const STATUS_NOT_ACTIVE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sitemap_exception}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('exception_url', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('exception_url', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, exception_url, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'exception_url' => 'Url исключения',
			'status' => 'статус',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('exception_url',$this->exception_url,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 'exception_url ASC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SitemapException the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
     * @return array
     */
    public function scopes()
    {
        return [
            'active' => [
                'condition' => 'status = :status',
                'params' => ['status' => self::STATUS_ACTIVE],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('SitemapModule.sitemap', 'Enabled'),
            self::STATUS_NOT_ACTIVE => Yii::t('SitemapModule.sitemap', 'Disabled'),
        ];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('SitemapModule.sitemap', '*unknown*');
    }

    public function getSitemapExceptionList()
    {
   		return CHtml::listData(self::model()->active()->findAll(), 'id', 'exception_url');
    }
}
