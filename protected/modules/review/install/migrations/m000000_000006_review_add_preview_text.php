<?php

class m000000_000006_review_add_preview_text extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{review}}', 'preview_text', 'TEXT NULL DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{review}}', 'preview_text');
    }
}
