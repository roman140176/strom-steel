<?php

class m371218_121819_store_product_add_column_is_typ extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_attribute}}', 'is_typ', "boolean not null default '0'");
	}

	public function safeDown()
	{
		$this->dropColumn('{{store_attribute}}', 'is_typ');
	}
}