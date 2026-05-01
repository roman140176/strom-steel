<?php

/**
 * Class DropdownFilterWidget
 */
class PanelFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'dropdown-panel-filter';

    /**
     * @var
     */
    public $attribute;
    public $category;

    /**
     * @throws Exception
     */
    public function init()
    {
        if (is_string($this->attribute)) {
            $this->attribute = CAttribute::model()->findByAttributes(['name' => $this->attribute]);
        }

        if (!($this->attribute instanceof CAttribute) || !$this->attribute->isMultipleValues()) {
            throw new Exception(Yii::t('StoreModulle.store','CAttribute error!'));
        }

        parent::init();
    }

    /**
     * @throws CException
     */
    public function run()
    {
        if (count($this->attribute->getOptionsList($this->category, true)) > 1) {
            $this->render($this->view, ['attribute' => $this->attribute,'category' => $this->category]);
        }
    }
}
