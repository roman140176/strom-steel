<?php
/**
 * ReviewsWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.review.widgets
 * @since 0.1
 *
 */
Yii::import('application.modules.review.models.Review');

class ReviewWidget extends yupe\widgets\YWidget
{
    public $product_id;
    public $view = 'reviewformwidget';

    public function init()
    {
        parent::init();

    }

    public function run()
    {
    $product = Product::model()->findByPk($this->product_id);
        $model = new Review('create');
        if (isset($_POST['Review'])) {
            $model->attributes = $_POST['Review'];
            $model->product_id = $this->product_id;
            if ($model->validate()) {
                $model->date_created =  date("Y-m-d H:i:s");
                if ($model->save(false)) {
                    $model->notification($this->module->email_notification);
                    Yii::app()->user->setFlash('review-success', 'Спасибо за Ваш отзыв!');
                    Yii::app()->controller->refresh();
                }
            }
        }
        $this->render($this->view, [
            'model' => $model,
            'product' => $product,
        ]);

       /* $model = new Review;

        $this->render($this->view, ['model' => $model]);*/
    }

}
