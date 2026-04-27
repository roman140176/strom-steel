<?php

/**
 * Class AttributeRender
 */
class AttributeRender
{
    /**
     * @param $attribute
     * @param null $value
     * @param null $name
     * @param array $htmlOptions
     * @return mixed|null|string
     */
    public static function renderField($attribute, $value = null, $name = null, $htmlOptions = [], $dropDown = false)
    {
        $name = $name ?: 'CAttribute['.$attribute->id.']';
        switch ($attribute->type) {
            case CAttribute::TYPE_SHORT_TEXT:
                return CHtml::textField($name, $value, $htmlOptions);
                break;
            case CAttribute::TYPE_TEXT:
                return Yii::app()->getController()->widget(
                    Yii::app()->getModule('store')->getVisualEditor(),
                    [
                        'name' => $name,
                        'value' => $value,
                    ],
                    true
                );
                break;
            case CAttribute::TYPE_DROPDOWN:
                $data = CHtml::listData($attribute->options, 'id', 'value');
                return CHtml::dropDownList($name, $value, $data, array_merge($htmlOptions, (['empty' => '---'])));
                break;
            case CAttribute::TYPE_CHECKBOX_LIST:

                $data = CHtml::listData($attribute->options, 'id', 'value');
                if ($dropDown) {
                    return CHtml::dropDownList($name, $value, $data, array_merge($htmlOptions, (['empty' => '---'])));
                }

                return CHtml::checkBoxList($name.'[]', $value, $data, ['empty' => '---']);
                break;
            case CAttribute::TYPE_CHECKBOX:
                return CHtml::checkBox($name, $value, CMap::mergeArray(['uncheckValue' => 0], $htmlOptions));
                break;
            case CAttribute::TYPE_NUMBER:
                return CHtml::numberField($name, $value, $htmlOptions);
                break;
            case CAttribute::TYPE_FILE:
                return CHtml::fileField($name.'[name]', null, $htmlOptions);
                break;
                 case CAttribute::TYPE_DROPDOWN_PANEL:
                $data = CHtml::listData($attribute->options, 'id', 'value');

                return CHtml::dropDownList($name, $value, $data, array_merge($htmlOptions, (['empty' => '---'])));
                break;
        }

        return null;
    }

    /**
     * @param $attribute
     * @param $value
     * @return string
     */
    public static function renderValue(CAttribute $attribute, $value, $template = '<p>{item}</p>')
    {
        $unit = $attribute->unit ? ' '.$attribute->unit : '';
        $res = null;
        switch ($attribute->type) {
            case CAttribute::TYPE_TEXT:
            case CAttribute::TYPE_SHORT_TEXT:
            case CAttribute::TYPE_NUMBER:
                $res = $value;
                break;
            case CAttribute::TYPE_DROPDOWN:
                $data = CHtml::listData($attribute->options, 'id', 'value');
                if(is_array($value)) {
                    $value = array_shift($value);
                }
                if (isset($data[$value])) {
                    $res .= $data[$value];
                }
                break;
            case CAttribute::TYPE_CHECKBOX_LIST:
                $data = CHtml::listData($attribute->options, 'id', 'value');
                if(is_array($value)) {
                    foreach (array_intersect(array_keys($data), $value) as $val) {
                        $res .= strtr($template, ['{item}' => $data[$val].'&nbsp;']);
                    }
                }
                break;
            case CAttribute::TYPE_CHECKBOX:
                $res = $value ? Yii::t("StoreModule.store", "Yes") : Yii::t("StoreModule.store", "No");
                break;
            case CAttribute::TYPE_DROPDOWN_PANEL:
                $data = CHtml::listData($attribute->options, 'id', 'value');
                if(is_array($value)) {
                    $value = array_shift($value);
                }
                if (isset($data[$value])) {
                    $res .= $data[$value];
                }
                break;
        }

        return $res.$unit;
    }
}