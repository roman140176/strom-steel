<?php

class m260602_091910_add_producer_sort_city extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_producer}}', 'city', 'INTEGER NOT NULL DEFAULT 3');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_producer}}', 'city');
    }
}