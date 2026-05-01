<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.CallbackFormEmailModal');

class CallbackFormEmailWidget extends yupe\widgets\YWidget
{
    public $view = 'callback-widget';


    public function run()
    {
        $model = new CallbackFormEmailModal;
        if (isset($_POST['CallbackFormEmailModal'])) {
            $model->attributes = $_POST['CallbackFormEmailModal'];
            if ($model->verify == '') {
                if ($model->validate()) {
                    Yii::app()->user->setFlash('successId', 'Ваше сообщение успешно отправлено');
                    Yii::app()->controller->refresh();
                }
            }
        }
        $this->render($this->view, [
            'model' => $model,
            // 'sucssesId' => $sucssesId,
        ]);
    }
}
