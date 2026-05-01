<?php

class m271204_051948_add_headers_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'hed_first', 'string');
        $this->addColumn("{{page_page}}", 'hed_second', 'string');

    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'hed_first');
        $this->dropColumn("{{page_page}}", 'hed_second');

    }
}
