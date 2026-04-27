<?php

class m190421_152416_add_title_short_news_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_news}}', 'title_short', 'string');
    }
}