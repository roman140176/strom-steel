<?php
/**
 * Форма обратный звонок
 */
class CallbackEmailModal extends CFormModel
{
    public $name;
    public $phone;
    public $body;
    public $verify;
    public $verifyCode;
    public $prodName;

    public function rules()
    {
        return [
            ['name, phone, body', 'required'],
            ['verify', 'safe'],
            ['verifyCode,prodName', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'phone' => 'Ваш телефон',
            'body' => 'Текст сообщения',
            'verify' => 'Код проверки',
            'prodName' => '',
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
            // $this->sentDataToRoistat();  // roistat отключён
            
            Yii::app()->mailMessage->raiseMailEvent('forma', $this->getAttributes());
        }
        return parent::afterValidate();
    }

    /**
     * Begin roistat
     */
    private function sentDataToRoistat()
    {
        $filePath = "{$_SERVER['DOCUMENT_ROOT']}/roistat/yii-action.php";
        if( is_file($filePath) ) {
            require_once $filePath;
            return sendDataToRoistat(
                'CallbackEmailModal',
                $_REQUEST['CallbackEmailModal']
            );
        }
        return false;
    }
}
