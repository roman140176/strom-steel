<?php

class m181204_051948_add_image_column_to_page_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn("{{page_page}}", 'image', 'string');
	}

	public function safeDown()
	{
		$this->dropColumn("{{page_page}}", 'image');
	}
}
