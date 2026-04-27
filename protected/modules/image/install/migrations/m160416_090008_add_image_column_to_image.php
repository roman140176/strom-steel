<?php

class m160416_090008_add_image_column_to_image extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{image_image}}', 'percent', 'string');
    }
}