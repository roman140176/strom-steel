<?php

/**
 * Class Range
 */
class Range extends CWidget
{
    /**
     * @var string
     */
    public $view = 'range';

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