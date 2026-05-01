<?php

class m260501_120000_add_view_and_layout_to_news extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $table = '{{news_news}}';
        $columns = $this->getDbConnection()->getSchema()->getTable($table)->columns;

        if (!isset($columns['layout'])) {
            $this->addColumn($table, 'layout', 'varchar(250)');
        }

        if (!isset($columns['view'])) {
            $this->addColumn($table, 'view', 'varchar(250)');
        }
    }

    public function safeDown()
    {
        $table = '{{news_news}}';
        $columns = $this->getDbConnection()->getSchema()->getTable($table)->columns;

        if (isset($columns['view'])) {
            $this->dropColumn($table, 'view');
        }

        if (isset($columns['layout'])) {
            $this->dropColumn($table, 'layout');
        }
    }
}
