<?php

class m240130_050115_add_column_meta_robots_to_news_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
    $this->addColumn('{{news_news}}', 'meta_robots', 'string');
	}

	public function safeDown()
	{
    $this->dropColumn('{{news_news}}', 'meta_robots');
	}
}