<?php

Yii::import('application.modules.store.models.*');

class SiblingProductsWidget extends yupe\widgets\YWidget
{
    /**
     * @var
     */
    public $model_product;
    /**
     * @var bool
     */
    public $limit = false;
    /**
     * @var string
     */
    public $view = 'default';

    /**
     * @return bool
     * @throws CException
     */
    public function run()
    {
        $criteria = new CDbCriteria();

        if($this->limit){
            $criteria->limit = $this->limit;
        }
        if($this->model_product){
            $criteria->addCondition("t.model_product={$this->model_product}");
        }

        $criteria->order = 't.position ASC';


        $products = Product::model()->findAllByAttributes(['model_product' => $this->model_product]);


        $this->render(
            $this->view,
            [
                'products' => $products,
                'model_product' => $this->model_product,
            ]
        );
    }
}