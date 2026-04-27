<?php

class m301218_141817_store_product_add_column_icon extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'icon_color', "string");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'icon_color');
    }
}