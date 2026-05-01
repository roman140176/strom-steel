<?php

class m321218_161817_store_product_add_column_complect extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'casing', "decimal(19,3)");
        $this->addColumn('{{store_product}}', 'platband', "decimal(19,3)");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'casing');
        $this->dropColumn('{{store_product}}', 'platband');
    }
}