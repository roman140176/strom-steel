<?php

class m271205_150639_add_field_cat_attribute_option extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_attribute_option}}', 'cat', 'string DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_attribute_option}}', 'cat');
    }
}