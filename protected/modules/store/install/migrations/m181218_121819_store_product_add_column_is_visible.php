<?php

class m181218_121819_store_product_add_column_is_visible extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_attribute}}', 'is_visible', "boolean not null default '0'");
	}

	public function safeDown()
	{
		$this->dropColumn('{{store_attribute}}', 'is_visible');
	}
}