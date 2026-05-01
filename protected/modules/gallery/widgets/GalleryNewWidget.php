<?php

/**
 * GalleryWidget виджет отрисовки галереи изображений
 *
 */

Yii::import('application.modules.gallery.models.*');

class GalleryNewWidget extends yupe\widgets\YWidget
{
    // сколько изображений выводить на одной странице
    public $limit = 10;

    // ID-галереи
    public $id;
    public $category_id;
    public $lists;
    public $name;

    public $view = 'gallerywidget';

    /**
     * Запускаем отрисовку виджета
     *
     * @return void
     */
    public function run()
    {
        $criteria = new CDbCriteria();
        if ($this->limit) {
                $criteria->limit = (int)$this->limit;
            }
        if($this->name){
            $model = Gallery::model()->findByAttributes(['name'=> $this->name]);
            }else{
                $model = Gallery::model()->findByPk($this->id);
            }
        $this->category_id = (int)$this->category_id;
        if ($this->category_id) {
                $criteria->addCondition("category_id = {$this->category_id}");
            }
       $this->lists = Gallery::model()->findAll($criteria);
        $this->render(
            $this->view,
            [
                'model' => $model,
                'lists' => $this->lists,
            ]
        );
    }
}
