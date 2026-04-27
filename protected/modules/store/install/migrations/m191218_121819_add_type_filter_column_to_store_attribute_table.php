<?php

class m191218_121819_add_type_filter_column_to_store_attribute_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_attribute}}', 'type_filter', 'integer COMMENT "Тип фильтра фронтенд"');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_attribute}}', 'type_filter');
    }
}