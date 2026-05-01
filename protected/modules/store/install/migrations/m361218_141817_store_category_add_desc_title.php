<?php

class m361218_141817_store_category_add_desc_title extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'desc_title', "string");

    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'desc_title');

    }
}