<?php
class m211204_051948_add_year_column_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'year', 'string');

    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'year');

    }
}