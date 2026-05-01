<?php

Yii::import('application.modules.store.models.Product');

/**
 * Class ProductTypeWidget
 *
 */
class ProductTypeWidget extends yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'view-widget';

    public $title = '';
    public $but_name = '';
    public $but_link = '';
    public $limit = 10;
    public $condition;
    public $delete = null;
    public $category_id;


    protected $models;

    public function init()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 't.position DESC';

        if($this->limit){
            $criteria->limit = $this->limit;
        }
        $this->category_id = (int)$this->category_id;

         if ($this->category_id) {
                $criteria->addCondition("category_id = {$this->category_id}");
            }
        if ($this->delete) {
                $criteria->addCondition($this->delete);
            }
        if($this->condition){
            $criteria->condition = $this->condition;
        }

        $this->models = Product::model()->published()->findAll($criteria);

        parent::init();
    }
    /**
     * @throws CException
     */
    public function run()
    {
        $this->render($this->view, [
            'models' => $this->models,
            'title' => $this->title,
            'but_name' => $this->but_name,
            'but_link' => $this->but_link,

        ]);
    }
}
