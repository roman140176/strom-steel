<?php

class m251204_051948_add_under_video_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'video_first', 'string');
        $this->addColumn("{{page_page}}", 'video_second', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'video_first');
        $this->dropColumn("{{page_page}}", 'video_second');
    }
}
