<?php

class m220729_061643_change_setting_field_param_value extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->alterColumn('{{yupe_settings}}', 'param_value', 'varchar(2000) NOT NULL');
	}

	public function safeDown()
	{
		$this->alterColumn('{{yupe_settings}}', 'param_value', 'varchar(500) NOT NULL');
	}
}