<?php

class m261204_051948_add_under_bonus_txt_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'bonus', 'text');

    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'bonus');

    }
}
