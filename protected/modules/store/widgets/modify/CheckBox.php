<?php

/**
 * Class CheckBox
 */
class CheckBox extends CWidget
{
    /**
     * @var string
     */
    public $view = 'check-box';

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