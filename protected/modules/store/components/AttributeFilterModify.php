<?php
Yii::import('application.modules.store.components.repository.AttributesRepository');
class AttributeFilterModify extends AttributeFilter
{
    public function getOptionList($attribute, $category = null)
    {
        $data = [];
        if ($category) {
            $ids = array_merge([$category->id], $category->getChildsArray($category->id));
            $products = Product::model()->findAllByAttributes(['category_id' => $ids]);
            $pids = CHtml::listData($products, 'id', 'id');
            $av = AttributeValue::model()->findAllByAttributes(['product_id' => $pids, 'attribute_id' => $attribute->id]);
            foreach ($av as $key => $value) {
                $data[] = $value->option;
            }
        } else {
            $data = $attribute->options;
        }


        return CHtml::listData($data, 'id', 'value');
    }

    public function getAttributeName($attribute)
    {
        return 'attr_'.$attribute->id;
    }

    public function getData($attribute, $mod=null)
    {
        $data = Yii::app()->request->getQuery($this->getAttributeName($attribute));
        if ($mod) {
            return $data[$mod];
        }
        return $data;
    }

    public function getTypeAttributesForSearchFromQuery(CHttpRequest $request)
    {
        $attributes = Yii::app()->getCache()->get('Store::filter::attributes');

        if (false === $attributes) {

            $attributes = [];

            $models = CAttribute::model()->findAll(
                ['select' => ['name', 'id', 'type']]
            );

            foreach ($models as $model) {
                $attributes[$model->name] = $model;
            }

            Yii::app()->getCache()->set('Store::filter::attributes', $attributes);
        }

        $result = [];

        $attributeValue = new AttributeValue();

        foreach ($attributes as $name => $attribute) {


            $searchParams = $request->getQuery('attr_'.$attribute->id);

            //пропускаем пустые значения
            if (null === $searchParams) {
                continue;
            }

            if (is_array($searchParams)) {
                if (isset($searchParams['from']) && null == $searchParams['from']) {
                    unset($searchParams['from']);
                }
                if (isset($searchParams['to']) && null == $searchParams['to']) {
                    unset($searchParams['to']);
                }
                if (empty($searchParams)) {
                    continue;
                }
            }

            if (!$searchParams) {
                continue;
            }

            $result[$attribute->name] = [
                'value' => $searchParams,
                'attribute_id' => (int)$attribute->id,
                'column' => $attributeValue->column($attribute->type),
            ];
        }

        return $result;
    }
}