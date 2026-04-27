<?php

Yii::import('application.modules.store.models.*');
class CatalogListWidget extends yupe\widgets\YWidget
{
    public $category_id = null;
    public $limit;
    public $delete = null;
    public $linked_id = null;
    public $view = 'view';
    protected $category;

    public function run()
    {
        $criteria = new CDbCriteria();

        if($this->limit){
            $criteria->limit = $this->limit;
        }

         if($this->delete){
            $criteria->addCondition($this->delete);
        }
         if($this->linked_id){
            $criteria->compare('linked_id', $this->linked_id);
            $this->category = StoreCategory::model()->published()->findAll($criteria);
        }

        // $criteria->order = $this->order;

        if($this->category_id){
            $criteria->compare('parent_id', $this->category_id);
            $this->category = StoreCategory::model()->published()->findAll($criteria);
            $criteria->compare('linked_id', $this->linked_id);
            $this->category = StoreCategory::model()->published()->findAll($criteria);
        }

        $this->render($this->view, [
            'category' => $this->category,
        ]);
    }
}