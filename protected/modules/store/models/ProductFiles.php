<?php

/**
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $title
 * @property string $alt
 * @property integer $group_id
 *
 * @property-read Product $product
 * @property-read ImageGroup $group
 * @method getImageUrl($width = 0, $height = 0, $options = [])
 */
class ProductFiles extends \yupe\models\YModel
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{store_product_files}}';
    }


    /**
     * @param null|string $className
     * @return $this
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['product_id', 'numerical', 'integerOnly' => true],
            ['name, title', 'length', 'max' => 250],
        ];
    }


    /**
     * @return array
     */
    public function relations()
    {
        return [
            'product' => [self::BELONGS_TO, 'Product', 'product_id'],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('store');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\FileUploadBehavior',
                'attributeName' => 'name',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->uploadPath.'/product',
                // 'resizeOnUpload' => true,
                // 'resizeOptions' => [
                //     'maxWidth' => 900,
                //     'maxHeight' => 900,
                // ],
            ],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
        ];
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return [
            'title' => 'Заголовок',
        ];
    }
}
