<?php

class m160618_145026_add_column_time_delivery extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_order}}', 'delivery_time', 'datetime');
	}
}