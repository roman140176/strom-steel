<?php

class m181218_121816_store_product_add_column_new_hit extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'is_home', "boolean not null default '0'");
        $this->addColumn('{{store_product}}', 'is_new', "boolean not null default '0'");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'is_new');
        $this->dropColumn('{{store_product}}', 'is_new');
    }
}