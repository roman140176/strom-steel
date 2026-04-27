<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.CalcPriceModel');

class CalcPriceWidget extends yupe\widgets\YWidget
{
  public $view = 'calc-price-form';

  public function run()
  {
    $model = new CalcPriceModel;
    if (isset($_POST['CalcPriceModel'])) {
      $model->attributes = $_POST['CalcPriceModel'];
      $model->file = CUploadedFile::getInstance($model, 'file');
      if ($model->validate()) {
        $mail  = Yii::app()->mail;
        $to    = Yii::app()->getModule('yupe')->email;
        $from  = 'info@stromsteel.ru';
        $theme = 'Расчёт стоимости с сайта';

        $body = Yii::app()->controller->renderPartial('//mail/mail/_calc-price', ['model' => $model], true);

        if ($model->file instanceof CUploadedFile) {
          $mail->AddAttachment($model->file->tempName, $model->file->name);
        }
        $mail->send($from, $to, $theme, $body);
        Yii::app()->user->setFlash('success', 'Ваше сообщение успешно отправлено');
        Yii::app()->controller->refresh();
      }
    }

    $this->render($this->view, [
      'model' => $model,
    ]);
  }
}
