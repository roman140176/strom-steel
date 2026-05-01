<?php
Yii::import('application.modules.mail.models.*');
Yii::import('application.modules.mail.models.form.CallbackEmailModal');

class CallbackEmailWidget extends yupe\widgets\YWidget
{
    public $view = 'callback-widget';
    public $id;
    public $succesId = 'success';
    public $modalId;


    public function run()
    {
        $model = new CallbackEmailModal;
        if (isset($_POST['CallbackEmailModal'])) {
            $model->attributes = $_POST['CallbackEmailModal'];
            if ($model->verify == '') {
                if ($model->validate()) {
                    Yii::app()->user->setFlash($this->succesId, 'Ваше сообщение успешно отправлено');
                    Yii::app()->controller->refresh();
                }
            }
        }
        if ($this->id) {
            $products = Product::model()->findByPk($this->id);
            $model->prodName = $products['name'];
        }
        $this->render($this->view, [
            'model' => $model,
            'products' => $products,
            'succesId' => $this->succesId,

        ]);
    }
}
