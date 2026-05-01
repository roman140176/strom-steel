<?php

/**
 * Class Text
 */
class Text extends CWidget
{
    /**
     * @var string
     */
    public $view = 'text';

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