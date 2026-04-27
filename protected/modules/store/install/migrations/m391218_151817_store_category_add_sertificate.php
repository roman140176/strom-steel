<?php

class m391218_151817_store_category_add_sertificate extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'sertificate', "text");

    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'sertificate');

    }
}