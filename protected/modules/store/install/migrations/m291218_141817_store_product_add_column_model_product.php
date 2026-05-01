<?php

class m291218_141817_store_product_add_column_model_product extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'model_product', "VARCHAR(100) DEFAULT NULL");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'model_product');
    }
}