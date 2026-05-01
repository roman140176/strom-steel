<?php

/**
 *
 */
class ContactFormModel extends CFormModel
{
    public $name;
    public $phone;
    public $body;
    public $email;
    public $image;
    public $verifyCode;


    public function rules()
    {
        return [
            ['name, phone', 'required'],
            ['body, email, image', 'safe'],
            ['verifyCode', 'safe'],
            ['image', 'file',
                'allowEmpty'=>false,
                'types'=>'doc,docx,jpeg,jpg,png',
                'maxFiles'=>1,
                'maxSize'=>1024 * 1024 * 5,
                'tooLarge'=>'Файл должен быть меньше 5 МБ',
                'message' => 'Необходимо прикрепить резюме (в формате .doc)'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  => 'Ваше имя',
            'phone' => 'Ваш телефон',
            'email' => 'E-mail',
            'body'  => 'Текст Сообщения',
        ];
    }
    public function beforeValidate(){
        if ($_POST['g-recaptcha-response']=='') {
            $this->addError('verifyCode', 'Пройдите проверку reCAPTCHA..');
        } else {

            $post = [
                'secret' => Yii::app()->params['secretkey'],
                'response' => $_POST['g-recaptcha-response'],

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
        return parent::beforeValidate();
    }
      public function afterValidate()
    {
        return parent::afterValidate();
    }

}

