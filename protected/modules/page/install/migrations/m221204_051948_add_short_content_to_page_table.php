<?php
class m221204_051948_add_short_content_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'short_content', 'text');

    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'short_content');

    }
}