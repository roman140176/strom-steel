<?php

Yii::import('application.modules.store.models.*');

class CatalogWidget extends yupe\widgets\YWidget
{
  public $id;
  public $ids;
  public $notIds;
  public $is_home;
  public $category_id = null;
  public $limit;
  public $delete = null;


  public $view = 'view';
  protected $category;

  public function run()
  {
    $criteria = new CDbCriteria();

    if ($this->limit) {
      $criteria->limit = $this->limit;
    }

    $criteria->order = 't.sort ASC';
    $criteria->compare('is_home', $this->is_home);

    if ($this->id) {
      $this->category = StoreCategory::model()->published()->findByPk($this->id);
    } else if ($this->ids) {
      $this->ids = explode(',', $this->ids);
      $this->category = StoreCategory::model()->findAllByPk($this->ids);
    } else if ($this->notIds) {
      $this->notIds = explode(',', $this->notIds);
      $criteria->addNotInCondition('id', $this->notIds);
      $this->category = StoreCategory::model()->published()->roots()->findAll($criteria);
    } else if ($this->category_id) {
      $criteria->compare('parent_id', $this->category_id);
      $this->category = StoreCategory::model()->published()->findAll($criteria);
    } else if ($this->delete) {
      $criteria->addCondition($this->delete);
    } else {
      $this->category = StoreCategory::model()->published()->roots()->findAll($criteria);
    }

    $this->render($this->view, [
      'category' => $this->category
    ]);
  }
}
