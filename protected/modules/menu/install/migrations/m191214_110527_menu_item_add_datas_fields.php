<?php

class m191214_110527_menu_item_add_datas_fields extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{menu_menu_item}}', 'data_target', 'varchar(250) DEFAULT NULL');
        $this->addColumn('{{menu_menu_item}}', 'data_toggle', 'varchar(250) DEFAULT NULL');
            }

    public function safeDown()
    {
        $this->dropColumn('{{menu_menu_item}}', 'data_target');
        $this->dropColumn('{{menu_menu_item}}', 'data_toggle');
    }
}