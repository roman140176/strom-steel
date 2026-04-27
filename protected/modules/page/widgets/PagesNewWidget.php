<?php

/**
 * PagesWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.widgets
 * @since 0.1
 *
 */
Yii::import('application.modules.page.models.*');

/**
 * Class PagesWidget
 */
class PagesNewWidget extends yupe\widgets\YWidget
{
  public $id;
  public $parent_id;
  public $limit;
  public $category_id;
  /**
   * @var string
   */
  public $view = 'pageswidget';
  public $showTitle = true;

  protected $pages;

  public function init()
  {
    if ($this->parent_id) {
      $criteria = new CDbCriteria([
        'condition' => 'parent_id=:parent_id',
        'params' => [':parent_id' => $this->parent_id],
      ]);
      $criteria->addCondition("status = 1");
      $criteria->order = 't.order DESC';

      if ($this->limit) {
        $criteria->limit = $this->limit;
      }

      $this->pages = Page::model()->findAll($criteria);
    } elseif ($this->id) {
      $this->pages = Page::model()->findByPk($this->id);
    }
    if ($this->category_id) {
      $criteria = new CDbCriteria([
        'condition' => 'category_id=:category_id',
        'params' => [':category_id' => $this->category_id],
      ]);
      $criteria->addCondition("status = 1");
      $criteria->order = 't.order ASC';

      if ($this->limit) {
        $criteria->limit = $this->limit;
      }

      $this->pages = Page::model()->findAll($criteria);
    } elseif ($this->id) {
      $this->pages = Page::model()->findByPk($this->id);
    }
    parent::init();
  }

  /**
   * @throws CException
   */
  public function run()
  {
    $this->render($this->view, [
      'pages' => $this->pages,
      'showTitle' => $this->showTitle
    ]);
  }
}
