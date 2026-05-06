<?php

class m260505_120000_create_customfield_group extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable('{{customfield_group}}', [
            'id' => 'pk',
            'name' => 'string',
            'module_id' => 'string default NULL',
        ], $this->getOptions());
    }

    public function safeDown()
    {
        $this->dropTable('{{customfield_group}}');
    }
}
