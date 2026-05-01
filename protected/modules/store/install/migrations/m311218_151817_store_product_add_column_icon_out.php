<?php

class m311218_151817_store_product_add_column_icon_out extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'icon_out', "VARCHAR(100) DEFAULT NULL");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'icon_out');
    }
}