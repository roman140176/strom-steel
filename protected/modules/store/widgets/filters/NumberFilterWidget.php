<?php

/**
 * Class NumberFilterWidget
 */
class NumberFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'number-filter';

    /**
     * @var
     */
    public $attribute;

    /**
     * @throws Exception
     */
    public function init()
    {
        if (is_string($this->attribute)) {
            $this->attribute = CAttribute::model()->findByAttributes(['name' => $this->attribute]);
        }

        if (!($this->attribute instanceof CAttribute) || $this->attribute->type != CAttribute::TYPE_NUMBER) {
            throw new Exception('Атрибут не найден или неправильного типа');
        }

        parent::init();
    }

    /**
     * @throws CException
     */
    public function run()
    {
        $this->render($this->view, ['attribute' => $this->attribute]);
    }
} 
