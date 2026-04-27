<?php

class m231204_051948_add_svg_column_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'svg', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'svg');
    }
}
