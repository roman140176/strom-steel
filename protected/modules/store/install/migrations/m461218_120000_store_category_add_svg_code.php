<?php

class m461218_120000_store_category_add_svg_code extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'svg_code', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'svg_code');
    }
}
