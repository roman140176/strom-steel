<?php

/**
 * This is the model class for table "{{review}}".
 *
 * The followings are the available columns in table '{{review}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $date_created
 * @property string $text
 * @property string $username
 * @property integer $moderation
 * @property integer $position
 * @property integer $category_id
 * @property integer $product_id
 * @property integer $rating
 * @property string $preview_text
 */
Yii::import('application.modules.store.models.*');

class Review extends yupe\models\YModel
{
    const STATUS_PUBLIC = 1;
    const STATUS_MODERATE = 2;

    public $verifyCode;
    public $validate;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{review}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['username, text', 'required'],
            ['moderation, position, rating, product_id', 'numerical', 'integerOnly'=>true],
            ["useremail", "email"],
            ['id, date_created, username, text, preview_text, moderation, useremail, image, position, product_id, rating', 'safe', 'on'=>'search'],
            /* array('image', 'file',
                'types'=>'jpg, jpeg, png',
                'allowEmpty'=>true,
            ),*/
            ['image, moderation, validate, category_id, position, date_created, product_id, preview_text', 'safe'],
        ];
    }
    public function behaviors()
    {
        $module = Yii::app()->getModule('review');

        return [
            'imageUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => 'review',
            ],
            'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
        ];
    }

    public function beforeValidate(){
        if($this->validate == 1){

        } else{
            if ($_POST['g-recaptcha-response']=='') {
                $this->addError('verifyCode', 'Пройдите проверку reCAPTCHA..');
            } else {
                // $ip = CHttpRequest::getUserHostAddress();
                $post = [
                    'secret' => Yii::app()->params['secretkey'],
                    'response' => $_POST['g-recaptcha-response'],
                    // 'remoteip' => $ip,
                ];

                $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response = curl_exec($ch);
                curl_close($ch);

                $response = CJSON::decode($response);
                if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                    $this->addError('verifyCode', implode(', ', $response['error-codes']));
                }
            }
        }
        return parent::beforeValidate();
    }
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'category' => [self::BELONGS_TO, 'Category', 'category_id'],
            'product' => [self::BELONGS_TO, 'Product', 'product_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'user_id'      => 'User',
            'date_created' => 'Date Created',
            'text'         => 'Ваш отзыв',
            'preview_text' => 'Краткий текст (для карусели)',
            'moderation'   => 'Статус',
            'username'     => 'Ваше имя',
            'useremail'    => 'Ваш E-mail',
            'image'        => 'Ваше Фото',
            'verifyCode'   => 'Код проверки',
            'category_id'  => 'Категория',
            'position'     => 'Сортировка',
            'product_id'   => 'Id Товара',
            'rating'       => 'Оценка',
        ];
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
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('date_created',$this->date_created,true);
        $criteria->compare('text',$this->text,true);
        $criteria->compare('moderation',$this->moderation);
        $criteria->compare('username',$this->username);
        $criteria->compare('useremail',$this->useremail);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('position',$this->position);
        $criteria->compare('product_id',$this->product_id);

        return new CActiveDataProvider($this, [
            'criteria'=>$criteria,
            'sort'    => ['defaultOrder' => 'position DESC'],
        ]);
    }

    public function notification($email)
    {
        $subject = "Уведомление о новом отзыве";
        $site = explode("//",Yii::app()->getBaseUrl(true))[1];

        $headers = "From: Admin ".$site." <no-replay@suvenir.ru>\r\n" .
                "Reply-To: no-replay@".$site."\r\n" .
             'MIME-Version: 1.0' . "\r\n" .
             'Content-type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: 8bit\r\nX-Priority: 1\r\nX-MSMail-Priority: High\r\n';
        $message = "Новый отзыв на сайте " . $site;
        if (mail($email, $subject, $message, $headers)) {
            /* echo "Запрос отправлен!"; */
        } else {
        }/*  echo "Произошла ошибка!" */;

    }

    public function getAllReviewsList($selfId = false)
    {
        $criteria = new CDbCriteria();
        //$criteria->order = "{$this->tableAlias}.order DESC, {$this->tableAlias}.date_created DESC";

/*      if ($selfId) {
            $otherCriteria = new CDbCriteria();
            $otherCriteria->addNotInCondition('id', (array)$selfId);
            $otherCriteria->group = "{$this->tableAlias}.slug, {$this->tableAlias}.id";
            $criteria->mergeWith($otherCriteria);
        } */

        return CHtml::listData($this->findAll($criteria), 'id', 'username');
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Review the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getUrl($absolute = false)
    {
        return $absolute ? Yii::app()->createAbsoluteUrl('/review/review/show/', ['id' => $this->id]) : Yii::app()->createUrl('/review/review/show/', ['id' => $this->id]);
    }
    public function getModerationList()
    {
        return [
            self::STATUS_PUBLIC   => 'Опубликован',
            self::STATUS_MODERATE => 'На модерации',
        ];
    }

    public function getStatusName()
    {
        $data = $this->getModerationList();
        if (isset($data[$this->moderation])) {
            return $data[$this->moderation];
        }
        return null;
    }
    public function scopes()
    {
        return [
            'published' => [
                'condition' => 'moderation  = :moderation',
                'params' => [
                    ':moderation' => self::STATUS_PUBLIC
                ]
            ],
        ];
    }

    public function getCategoryList()
    {
        return CHtml::listData(Category::model()->published()->findAll(), 'id', 'name');
    }

    public function getProductList()
    {
        return CHtml::listData(Product::model()->published()->findAll(), 'id', 'name');
    }
    public function afterSave()
    {
        $this->ratingUpdate();
        return parent::afterSave();
    }

    public function afterDelete()
    {
        $this->ratingUpdate();
        return parent::afterDelete();
    }

    public function ratingUpdate()
    {
        // Пересчет рейтинга у товара
        if ($this->product_id) {
            // получить скалярное значение
            $rating = Yii::app()
                ->db
                ->createCommand('SELECT SUM(`rating`) / COUNT(*) FROM yupe_review WHERE product_id = :product_id and moderation = :moderation')
                ->bindValue(':product_id', $this->product_id)
                ->bindValue(':moderation', self::STATUS_PUBLIC)
                ->queryScalar();

            // Обновить рейтинг
            $product = Product::model()->findByPk($this->product_id);
            $product->raiting = $rating;
            $product->save();
        }
    }
}
