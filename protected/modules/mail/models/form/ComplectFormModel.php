<?php

/**
 *
 */
class ComplectFormModel extends CFormModel
{
    public $name;
    public $phone;
    public $complectName;
    public $code;
    public $services;
    public $verifyCode;


    public function rules()
    {
        return [
            ['name, phone', 'required'],
            ['code, services, complectName', 'safe'],
            ['verifyCode', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  => 'Ваше имя',
            'phone' => 'Ваш телефон',
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
        if (empty($this->getErrors())) {
            $srIds = explode(',', $this->services);
            $servicesResourse = Page::model()->getComplectList();
            $services = '';
            foreach ($srIds as $key => $srId) {
                if (isset($servicesResourse[$srId])) {
                    $services .= $servicesResourse[$srId].'<br>';
                }
            }
            $this->services = $services;

            Yii::app()->mailMessage->raiseMailEvent('komplekt', $this->getAttributes());
        }
        return parent::afterValidate();
    }
}

