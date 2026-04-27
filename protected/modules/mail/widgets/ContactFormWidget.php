<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.ContactFormModel');
/**
 *
 */
class ContactFormWidget extends \yupe\widgets\YWidget
{

    public $view = 'contact-form-widget';
    public function run()
    {
        $model = new ContactFormModel;
        if (isset($_POST['ContactFormModel'])) {
            $model->attributes = $_POST['ContactFormModel'];
            if ($model->validate()) {
                $mail = Yii::app()->mail;
                $to = Yii::app()->getModule('yupe')->email;
                $from = 'www-data@localhost.localdomain';
                $theme = "Уведомление";


                $filetoVote = $_FILES['ContactFormModel']['tmp_name']['image'];
                $filename = $_FILES['ContactFormModel']['name']['image'];
                $body = Yii::app()->controller->renderPartial('//mail/mail/_main', ['model' => $model], true);

                $mail->AddAttachment($filetoVote, $filename);
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
