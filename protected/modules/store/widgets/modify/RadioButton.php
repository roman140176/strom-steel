<?php

/**
 * Class RadioButton
 */
class RadioButton extends CWidget
{
    /**
     * @var string
     */
    public $view = 'radio-button';

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