<?php
Yii::import('application.modules.store.components.repository.AttributesRepository');

/**
 * Class AttributesFilterModifyWidget
 */
class AttributesFilterModifyWidget extends \yupe\widgets\YWidget
{
    /**
     * @var
     */
    public $attributes;

    /**
     * @var
     */
    public $category;

    /**
     * @var AttributesRepository
     */
    protected $attributesRepository;


    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->attributesRepository = new AttributesRepository();
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        if ($this->category) {
            $this->attributes = $this->attributesRepository->getForCategory($this->category);
        }

        if ('*' === $this->attributes) {
            $this->attributes = CAttribute::model()->with(['options.parent'])->cache($this->cacheTime)->findAll([
                'condition' => 't.is_filter = 1',
                'order' => 't.sort DESC',
            ]);
        }

        foreach ($this->attributes as $attribute) {

            $model = is_string($attribute) ? CAttribute::model()->findByAttributes([
                'name' => $attribute,
                'is_filter' => \yupe\components\WebModule::CHOICE_YES,
            ]) : $attribute;

            if ($model) {
                if (!$model->type_filter) {
                    continue;
                }
                switch ($model->type_filter) {
                    case CAttribute::TYPE_FILTER_TEXT:
                        $this->widget('application.modules.store.widgets.modify.Text', ['attribute' => $model]);
                        break;
                    case CAttribute::TYPE_FILTER_CHECK_BOX:
                        $this->widget('application.modules.store.widgets.modify.CheckBox', ['attribute' => $model]);
                        break;
                    case CAttribute::TYPE_FILTER_DROP_DOWN:
                        $this->widget('application.modules.store.widgets.modify.DropDown', ['attribute' => $model]);
                        break;
                    case CAttribute::TYPE_FILTER_DROP_DOWN_CHECK_BOX:
                        $this->widget('application.modules.store.widgets.modify.DropDownCheckBox', ['attribute' => $model]);
                        break;
                    case CAttribute::TYPE_FILTER_RANGE:
                        $this->widget('application.modules.store.widgets.modify.Range', ['attribute' => $model]);
                        break;
                    case CAttribute::TYPE_FILTER_CHECK_BOX_LIST:
                        $this->widget('application.modules.store.widgets.modify.CheckBoxList', [
                            'attribute' => $model,
                            'category' => $this->category,
                        ]);
                        break;
                    case CAttribute::TYPE_FILTER_RADIO_BUTTON:
                        $this->widget('application.modules.store.widgets.modify.RadioButton', ['attribute' => $model]);
                        break;
                }
            }
        }
    }
}
