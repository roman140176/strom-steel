<?php

/**
 *
 */
class ContactInnerModel extends CFormModel
{
    public $name;
    public $phone;
    public $body;
    public $code;
    public $verifyCode;



    public function rules()
    {
        return [
            ['name, phone, body', 'required'],
            ['code', 'safe'],
            ['verifyCode', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  => 'Ваше имя',
            'phone' => 'Ваш телефон',
            'body' => 'Адрес замера',
        ];
    }

    public function beforeValidate()
    {
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
        return parent::beforeValidate();
    }

     public function afterValidate()
    {
        if (empty($this->getErrors())) {
            Yii::app()->mailMessage->raiseMailEvent('onlayn-zamer', $this->getAttributes());
        }
        return parent::afterValidate();
    }
}

