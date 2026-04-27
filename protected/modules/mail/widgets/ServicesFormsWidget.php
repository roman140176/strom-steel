<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.ServicesFormsModel');

class ServicesFormsWidget extends yupe\widgets\YWidget
{
  public $view = 'services-form';
  public $img = '1.jpg';


  public function run()
  {
    $model = new ServicesFormsModel;
    if (isset($_POST['ServicesFormsModel'])) {
      $model->attributes = $_POST['ServicesFormsModel'];
      $model->file = CUploadedFile::getInstance($model, 'file');
      if ($model->validate()) {
        $mail  = Yii::app()->mail;
        $to    = Yii::app()->getModule('yupe')->email;
        $from  = 'info@stromsteel.ru';
        $theme = 'Сообщение с сайта';

        $body = Yii::app()->controller->renderPartial('//mail/mail/_main', ['model' => $model], true);

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
      'img' => $this->img,
    ]);
  }
}
