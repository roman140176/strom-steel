<?php

class m231120_070251_add_meta_robots extends yupe\components\DbMigration
{
  public function safeUp()
  {
    $this->addColumn('{{page_page}}', 'meta_robots', 'string');
  }

  public function safeDown()
  {
    $this->dropColumn('{{page_page}}', 'meta_robots');
  }
}
