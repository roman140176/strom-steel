<?php

class m281204_051948_add_ad_img_column_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'img', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'img');
    }
}
