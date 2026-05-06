<?php

class m260505_120100_add_data_column_to_news extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_news}}', 'data', 'longtext');
    }

    public function safeDown()
    {
        $this->dropColumn('{{news_news}}', 'data');
    }
}
