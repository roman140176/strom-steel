<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.ContactFormsModel');
/**
 *
 */
class ContactFormsWidget extends \yupe\widgets\YWidget
{
    public $view = 'contact-form-widget';
    public function run()
    {
        $model = new ContactFormsModel;
        if (isset($_POST['ContactFormsModel'])) {
            $model->attributes = $_POST['ContactFormsModel'];
            if ($model->validate()) {
                Yii::app()->user->setFlash('success', 'Ваше сообщение успешно отправлено');
                Yii::app()->controller->refresh();
            }
        }

        $this->render($this->view, [
            'model' => $model,
        ]);
    }
}
