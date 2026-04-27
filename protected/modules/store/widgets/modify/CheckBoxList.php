<?php

/**
 * Class CheckBoxList
 */
class CheckBoxList extends CWidget
{
    /**
     * @var string
     */
    public $view = 'check-box-list';

    /**
     * @var
     */
    public $attribute;
    public $category;

    public function run()
    {
        $this->render($this->view, [
            'attribute' => $this->attribute,
            'category' => $this->category,
        ]);
    }
}