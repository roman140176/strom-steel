<?php

class m000001_000001_slider_add_column extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{slider}}', 'image_xs', 'varchar(250)');
	}

	public function safeDown()
	{
        $this->dropColumn('{{slider}}', 'image_xs');
	}
}