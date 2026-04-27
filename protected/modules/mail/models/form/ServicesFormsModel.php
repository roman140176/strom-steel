<?php

/**
 *
 */
class ServicesFormsModel extends CFormModel
{
  public $name;
  public $phone;
  public $body;
  public $email;
  public $file;
  public $verifyCode;


  public function rules()
  {
    return [
      ['name, phone', 'required'],
      ['body, email', 'safe'],
      ['verifyCode', 'safe'],
      [
        'file', 'file',
        'allowEmpty' => true,
        'types' => 'doc,docx,jpeg,jpg,png,pdf',
        'maxFiles' => 1,
        'maxSize' => 1024 * 1024 * 5,
        'tooLarge' => 'Файл должен быть меньше 5 МБ',
      ],
    ];
  }

  public function attributeLabels()
  {
    return [
      'name'  => 'Ваше имя',
      'phone' => 'Ваш телефон',
      'email' => 'Ваш E-mail',
      'body'  => 'Ваше сообщение',
      'file'  => 'Прикрепить файл',
    ];
  }
  public function beforeValidate()
  {
    // Если флаг recaptchaEnabled выключен (например, на локалке) — пропускаем проверку.
    if (empty(Yii::app()->params['recaptchaEnabled'])) {
      return parent::beforeValidate();
    }

    $captchaResponse = $_POST['g-recaptcha-response'] ?? '';
    if ($captchaResponse === '') {
      $this->addError('verifyCode', 'Пройдите проверку reCAPTCHA.');
    } else {
      $post = [
        'secret'   => Yii::app()->params['secretkey'],
        'response' => $captchaResponse,
      ];
      $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      $response = curl_exec($ch);
      curl_close($ch);

      $response = CJSON::decode($response);
      if (isset($response['success']) && $response['success'] === false) {
        $codes = $response['error-codes'] ?? ['recaptcha-error'];
        $this->addError('verifyCode', implode(', ', $codes));
      }
    }
    return parent::beforeValidate();
  }
  public function afterValidate()
  {
    return parent::afterValidate();
  }
}
