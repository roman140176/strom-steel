<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.CalcFormModel');
/**
 *
 */

class CalcWidget extends \yupe\widgets\YWidget
{



    public function run()
    {
        $model = new CalcFormModel();
        if (isset($_POST['CalcFormModel'])) {
            if ($_POST['CalcFormModel']['kview']==0) {
                $model->scenario = 'pView';
            }
            if ($_POST['CalcFormModel']['kview']==1) {
                $model->scenario = 'lView';
            }
            if ($_POST['CalcFormModel']['kview']==2) {
                $model->scenario = 'rView';
            }
            if ($_POST['CalcFormModel']['kview']==3) {
                $model->scenario = 'prView';
            }
            $model->attributes = $_POST['CalcFormModel'];
            $mod = new MailMailOrder;
            $mod->name = "Заявка";
            $mod->text = Yii::app()->controller->renderPartial("//mail/mail/_email-order", ['model' => $model], true);
            if ($model->validate()) {
                // $mod->save(false);

                $mail = Yii::app()->mail;
                $to = Yii::app()->getModule('yupe')->email;
                $from = 'www-data@localhost.localdomain';
                $theme = "Уведомление";


                $filetoVote = $_FILES['CalcFormModel']['tmp_name']['image'];
                $filename = $_FILES['CalcFormModel']['name']['image'];
                $body = Yii::app()->controller->renderPartial('//mail/mail/_calc', ['model' => $model], true);

                $mail->AddAttachment($filetoVote, $filename);
                $mail->send($from, $to, $theme, $body);

                Yii::app()->user->setFlash('calc-form-success', 'Заявка успешно отправлена');
            }
        }

        $this->render('calc-form-widget', ['model' => $model]);
    }
}