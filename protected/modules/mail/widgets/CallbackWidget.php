<?php

/**
 * FormQuestionsWidget виджет формы "остались вопросы"
 */
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.CallbackFormModal');
Yii::import('application.modules.mail.models.form.CallbackServicesFormModal');

class CallbackWidget extends yupe\widgets\YWidget
{
    public $view = 'callback-widget';
    public $model = 'CallbackFormModal';
    public $title = '';

    public function run()
    {
        $model = new $this->model;
        $sucssesId = 'sucsses-'.$this->view;
        if (isset($_POST[$this->model])) {
            $model->attributes = $_POST[$this->model];
                if ($model->validate()) {
                    Yii::app()->user->setFlash($sucssesId, 'Ваша заявка успешно отправлена');
                    Yii::app()->controller->refresh();
                }

        }
        $this->render($this->view, [
            'model' => $model,
            'title' => $this->title,
            'sucssesId' => $sucssesId,
        ]);
    }
}
