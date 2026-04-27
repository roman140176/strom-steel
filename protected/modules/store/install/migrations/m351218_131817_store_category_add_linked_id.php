<?php

class m351218_131817_store_category_add_linked_id extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'linked_id', "integer default null");

    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'linked_id');

    }
}