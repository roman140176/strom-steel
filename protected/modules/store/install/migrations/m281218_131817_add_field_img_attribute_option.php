<?php

class m281218_131817_add_field_img_attribute_option extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_attribute_option}}', 'image', "string");

    }

    public function safeDown()
    {
        $this->dropColumn('{{store_attribute_option}}', 'image');

    }
}