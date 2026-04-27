<?php

class m141004_140001_create_sitemap_exception extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            "{{sitemap_exception}}",
            [
                "id" => "pk",
                "exception_url" => "varchar(250) not null",
                "status" => "integer not null default '0'",
            ],
            $this->getOptions()
        );
    }

    public function safeDown()
    {
		$this->dropTable('{{sitemap_exception}}');
    }
}
