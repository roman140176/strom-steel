<?php

/**
 * Class CategoryFilterWidget
 */
class CategoryFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'category-filter';

    /**
     * @var
     */
    public $category;
    public $limit = 1000;
    public $parent_id;

    /**
     * @throws CException
     */
    public function run()
    {
        $categories = $this->category ? $this->category->child() : StoreCategory::model()->roots();
        $this->render($this->view, [
            'categories' => $categories->published()->findAllByPk([
                'perent_id' => $this->parent_id
            ]),
        ]);
    }
}
