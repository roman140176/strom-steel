<?php
/**
 * ReviewNewWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.review.widgets
 * @since 0.1
 *
 */
Yii::import('application.modules.review.models.*');

class ReviewNewWidget extends yupe\widgets\YWidget
{
	public $product_id;
	public $view = 'review';

    public function run()
    {
		$criteria = new CDbCriteria();

        $criteria->addCondition("t.moderation = 1");
        $criteria->order = 't.position DESC';
        
        if($this->product_id){
            $criteria->addCondition("t.product_id = {$this->product_id}");
        }

        // $model = Review::model()->findAll($criteria);

        $dataProvider = new CActiveDataProvider('Review', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 5
            ],
        ]);

        $this->render($this->view, [
        	'dataProvider' => $dataProvider
        ]);
    }
}
