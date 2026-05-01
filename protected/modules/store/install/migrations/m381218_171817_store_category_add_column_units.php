<?php

class m381218_171817_store_category_add_column_units extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'units', "string");

    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'units');

    }
}