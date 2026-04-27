<?php

class m181218_121817_store_category_add_column_home extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'is_home', "boolean not null default '0'");
        $this->addColumn('{{store_category}}', 'is_card_big', "boolean not null default '0'");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'is_home');
        $this->dropColumn('{{store_category}}', 'is_home');
    }
}