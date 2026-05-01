<?php

class m181218_121818_store_product_add_column_is_recomended extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'is_recomended', "boolean not null default '0'");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'is_recomended');
    }
}