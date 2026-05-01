<?php

class m241204_051948_add_under_title_column_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'under_title', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'under_title');
    }
}
