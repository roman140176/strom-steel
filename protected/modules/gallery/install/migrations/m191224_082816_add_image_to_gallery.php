<?php

class m191224_082816_add_image_to_gallery extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{gallery_gallery}}", 'image', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn("{{gallery_gallery}}", 'image');
    }
}
