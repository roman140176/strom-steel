<?php

class m221218_131817_store_category_add_column_thumbnale extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'thumbnale', "string");

    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'thumbnale');

    }
}