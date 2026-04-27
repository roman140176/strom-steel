<?php

/**
 * Class StoreCategoryRepository
 */
class StoreCategoryRepository extends CApplicationComponent
{

    /**
     * @param $slug
     * @return StoreCategory
     */
     protected $storeCountPage;
     protected $attributeFilter;

      public function init()
    {
        $module = Yii::app()->getModule('store');

        $this->storeCountPage = 12;

        if(isset($_COOKIE["store_count"])) {
            $this->storeCountPage = $_COOKIE["store_count"];
        }


        $this->attributeFilter = Yii::app()->getComponent('attributesFilter');
    }

    public function getByAlias($slug)
    {
        return StoreCategory::model()->published()->find(
            'slug = :slug',
            [
                ':slug' => $slug,
            ]
        );
    }

    /**
     *
     */
    public function getAllDataProvider()
    {
        return new CArrayDataProvider(
            StoreCategory::model()->published()->getMenuList(1), [
                'id' => 'id',
                'pagination' => [
                    'pageSize' => Yii::app()->getModule('store')->perPage,
                    'pageVar' => 'page',
                ]
            ]
        );
    }

    /**
     * @param $path
     * @return mixed
     */
    public function getByPath($path)
    {
        return StoreCategory::model()->published()->findByPath($path);
    }
     public function getById($id)
    {
        return StoreCategory::model()->published()->findByPath($id);
    }
}