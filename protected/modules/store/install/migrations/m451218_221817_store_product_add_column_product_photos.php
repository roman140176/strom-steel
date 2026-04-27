<?php

class m451218_221817_store_product_add_column_product_photos extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{store_product_photos}}',
            [
                'id'       => 'pk',
                'product_id'  => 'integer DEFAULT NULL',
                'image'       => 'string COMMENT "Изображение" not null',
                'title'       => 'string COMMENT "Название изображения" not null',
                'alt'         => 'string COMMENT "Alt изображения" not null',
                'position'    => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys("{{store_product_photos}}");
    }
}