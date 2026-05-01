<?php

class m010004_010000_add_marks_stock_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{stocks}}', 'marks', 'integer default null');
    }
    public function safeDown()
    {
       $this->dropColumn('{{stocks}}', 'marks', 'string');
    }
}
