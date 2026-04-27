<?php

class m191204_051948_add_icon_column_to_page_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn("{{page_page}}", 'icon', 'string');
	}

	public function safeDown()
	{
		$this->dropColumn("{{page_page}}", 'icon');
	}
}
