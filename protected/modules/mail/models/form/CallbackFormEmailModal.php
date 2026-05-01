<?php

/**
 * Форма обратный звонок
 */
class CallbackFormEmailModal extends CFormModel
{
    public $name;
    public $phone;
    public $body;
    public $verify;
    public $verifyCode;
    public $utm_source;
    public $utm_medium;
    public $utm_campaign;
    public $utm_content;
    public $utm_term;

    public function rules()
    {
        return [
            ['name, phone, body', 'required'],
            ['verify', 'safe'],
            ['verifyCode', 'safe'],
            ['utm_source, utm_medium, utm_campaign, utm_content, utm_term', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'phone' => 'Ваш телефон',
            'body' => 'Текст сообщения',
            'verify' => 'Код проверки',
            'utm_source' => 'utm_source',
            'utm_medium' => 'utm_medium',
            'utm_campaign' => 'utm_campaign',
            'utm_content' => 'utm_content',
            'utm_term' => 'utm_term',
        ];
    }

    public function beforeValidate()
    {
        // if ($_POST['g-recaptcha-response']=='') {
        //     $this->addError('verifyCode', 'Пройдите проверку reCAPTCHA..');
        // } else {
        //     // $ip = CHttpRequest::getUserHostAddress();
        //     $post = [
        //         'secret' => Yii::app()->params['secretkey'],
        //         'response' => $_POST['g-recaptcha-response'],
        //         // 'remoteip' => $ip,
        //     ];

        //     $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        //     $response = curl_exec($ch);
        //     curl_close($ch);

        //     $response = CJSON::decode($response);
        //     if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
        //         $this->addError('verifyCode', implode(', ', $response['error-codes']));
        //     }
        // }
        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        if (empty($this->getErrors())) {
            $this->sentDataToRoistat(); // Begin roistat
            // if (Yii::app()->hasModule('amocrm')) {
            //     $amocrm = new Amocrm;
            //     $amocrm->addLead($this->getAttributes());
            // }

            Yii::app()->mailMessage->raiseMailEvent('napisat-nam', $this->getAttributes());
        }
        return parent::afterValidate();
    }

    /**
     * Begin roistat
     */
    private function sentDataToRoistat()
    {
        $filePath = "{$_SERVER['DOCUMENT_ROOT']}/roistat/yii-action.php";
        if (is_file($filePath)) {
            require_once $filePath;
            return sendDataToRoistat(
                'CallbackFormEmailModal',
                $_REQUEST['CallbackFormEmailModal']
            );
        }
        return false;
    }

    public function getUtmSource()
    {
        if ($_GET["utm_source"]) {
            return $_GET["utm_source"];
        } elseif (isset($_COOKIE["utm_source"])) {
            return $_COOKIE["utm_source"];
        } else {
            return '';
        }
    }

    public function getUtmMedium()
    {
        if ($_GET["utm_medium"]) {
            return $_GET["utm_medium"];
        } elseif (isset($_COOKIE["utm_medium"])) {
            return $_COOKIE["utm_medium"];
        } else {
            return '';
        }
    }

    public function getUtmCampaing()
    {
        if ($_GET["utm_campaign"]) {
            return $_GET["utm_campaign"];
        } elseif (isset($_COOKIE["utm_campaign"])) {
            return $_COOKIE["utm_campaign"];
        } else {
            return '';
        }
    }

    public function getUtmContent()
    {
        if ($_GET["utm_content"]) {
            return $_GET["utm_content"];
        } elseif (isset($_COOKIE["utm_content"])) {
            return $_COOKIE["utm_content"];
        } else {
            return '';
        }
    }

    public function getUtmTerm()
    {
        if ($_GET["utm_term"]) {
            return $_GET["utm_term"];
        } elseif (isset($_COOKIE["utm_term"])) {
            return $_COOKIE["utm_term"];
        } else {
            return '';
        }
    }
}
