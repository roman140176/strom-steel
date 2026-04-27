<?php
class m201204_051948_add_promo_column_to_page_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{page_page}}", 'promo', 'text');
        $this->addColumn("{{page_page}}", 'previewtext', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn("{{page_page}}", 'promo');
        $this->dropColumn("{{page_page}}", 'previewtext');
    }
}