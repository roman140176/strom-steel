<?php

/**
 * Class AttributesRepository
 */
class AttributesRepository extends CApplicationComponent
{
    /**
     * @param StoreCategory $category
     * @return CAttribute[]
     */
    public function getForCategory($category)
    {
        $criteria = new CDbCriteria([
            'condition' => 't.is_filter = 1 AND t.type != :type',
            'params' => [
                ':type' => CAttribute::TYPE_TEXT,
            ],
            'join' => 'LEFT JOIN {{store_type_attribute}} ON t.id = {{store_type_attribute}}.attribute_id
                       LEFT JOIN {{store_type}} ON {{store_type_attribute}}.type_id = {{store_type}}.id
                       LEFT JOIN {{store_product}} AS products ON products.type_id = {{store_type}}.id
                       LEFT JOIN {{store_attribute_group}} `group` ON `group`.id = t.group_id',
            'distinct' => true,
            'order' => '`group`.position ASC, t.sort ASC',
        ]);

        $categories = [];
        if (is_array($category)) {
            foreach ($category as $categ) {
                $categories = array_merge($categories, $categ->getChildsArray()+[$categ->id]);
            }
        } else {
            $categories = $category->getChildsArray()+[$category->id];
        }

        if (!empty($categories)) {
            $categoriesCriteria = new CDbCriteria();
            $categoriesCriteria->addInCondition('products.category_id', $categories, 'OR');
            $criteria->mergeWith($categoriesCriteria, 'AND');
        } else {
            if (is_array($category)) {
                $criteria->addInCondition('products.category_id', CHtml::listData($category, 'id', 'id'));
            } else {
                $criteria->addCondition('products.category_id = :category');
                $criteria->params[':category'] = $category->id;
            }
        }

        return CAttribute::model()->findAll($criteria);
    }
}