<?php

class m341218_121818_add_product_big extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'big_cart', 'integer DEFAULT "0"');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'big_cart');
    }
}