<?php

/**
 * Class DropDown
 */
class DropDown extends CWidget
{
    /**
     * @var string
     */
    public $view = 'drop-down';

    /**
     * @var
     */
    public $attribute;

    public function run()
    {
        $this->render($this->view, [
            'attribute' => $this->attribute,
        ]);
    }
}