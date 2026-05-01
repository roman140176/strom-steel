<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.ComplectFormModel');
// Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
/**
 *
 */
class ComplectFormWidget extends \yupe\widgets\YWidget
{

    public function run()
    {
        $model = new ComplectFormModel;
        if (isset($_POST['ComplectFormModel'])) {
            $model->attributes = $_POST['ComplectFormModel'];
            if ($model->validate()) {
                Yii::app()->user->setFlash('success3', 'Ваше сообщение успешно отправлено');
                Yii::app()->controller->refresh();
            }
        }

        $this->render('complect-form-widget', [
            'model' => $model,
        ]);
    }
}
