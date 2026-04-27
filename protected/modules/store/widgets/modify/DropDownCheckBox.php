<?php

/**
 * Class DropDownCheckBox
 */
class DropDownCheckBox extends CWidget
{
    /**
     * @var string
     */
    public $view = 'drop-down-check-box';

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