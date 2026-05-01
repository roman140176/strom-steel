<?php

class m160715_160737_add_title_short extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{contentblock_content_block}}','title_short','string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{contentblock_content_block}}', 'title_short');
    }
}