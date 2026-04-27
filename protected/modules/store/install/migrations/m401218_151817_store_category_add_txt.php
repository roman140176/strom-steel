<?php

class m401218_151817_store_category_add_txt extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'txt', "text");

    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'txt');

    }
}