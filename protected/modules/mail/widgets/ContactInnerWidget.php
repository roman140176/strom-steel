<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.ContactInnerModel');
/**
 *
 */
class ContactInnerWidget extends \yupe\widgets\YWidget
{

    public function run()
    {
        $model = new ContactInnerModel;
        if (isset($_POST['ContactInnerModel'])) {
            $model->attributes = $_POST['ContactInnerModel'];
            if ($model->validate()) {
                Yii::app()->user->setFlash('success', 'Ваше сообщение успешно отправлено');
                Yii::app()->controller->refresh();
            }
        }

        $this->render('contact-form-widget', [
            'model' => $model,
        ]);
    }
}
