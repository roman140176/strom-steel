<?php

/**
 * Class PriceFilterWidget
 */
class PriceFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'price-filter';
    public $category_id;


    /**
     * @throws CException
     */
    public function run()
    {
        $model = StoreCategory::model()->findByPk($this->category_id);
        if($model){
            $poducts = array_merge($model->getChildsArray(), [$model->id]);
            $cost =  Yii::app()->getDb()->createCommand()
                ->select('min(price_result) as minPrice, max(price_result) as maxPrice')
                ->from('{{store_product}}')
                ->where(['in', 'category_id',$poducts])
                ->queryRow();
        }else{
            $cost = Yii::app()->db->createCommand('SELECT max(price_result) as maxPrice FROM yupe_store_product where 1')->queryRow();
        }
        $this->render($this->view, ['cost' => $cost]);
    }
}