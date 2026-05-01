<?php

class m291204_051948_add_gallery_name_column_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'gallery_name', 'integer');
    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'gallery_name');
    }
}
