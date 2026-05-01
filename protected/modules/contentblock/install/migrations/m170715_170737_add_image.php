<?php

class m170715_170737_add_image extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{contentblock_content_block}}','image','string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{contentblock_content_block}}', 'image');
    }
}