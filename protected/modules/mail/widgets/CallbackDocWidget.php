<?php

/**
 * FormQuestionsWidget виджет формы "остались вопросы"
 */
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.CallbackDocModal');

class CallbackDocWidget extends yupe\widgets\YWidget
{
    public $view = 'callback-widget';

    public function run()
    {
        $model = new CallbackDocModal;
        if (isset($_POST['CallbackDocModal'])) {
            $model->attributes = $_POST['CallbackDocModal'];

            $mod = new MailMailOrder;
            $mod->name = "Вызов врача";
            $mod->text = Yii::app()->controller->renderPartial("//mail/mail/_email-order", ['model' => $model], true);
            if ($model->verify == '') {
                if ($model->validate()) {

                    $mod->save(false);

                    Yii::app()->user->setFlash('success1', 'Ваша заявка успешно отправлена');
                    Yii::app()->controller->refresh();
                }
            }
        }
        $this->render('callback-widget', [
            'model' => $model
        ]);
    }
}
