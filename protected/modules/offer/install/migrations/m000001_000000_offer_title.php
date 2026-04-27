<?php
/**
 * Offer install migration
 * Класс миграций для модуля Offer:
 *
 * @category YupeMigration
 * @package  yupe.modules.offer.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000001_000000_offer_title extends yupe\components\DbMigration
{
   public function safeUp()
    {
        $this->addColumn("{{offer}}", 'title', 'string');
        $this->addColumn("{{offer}}", 'title_sort', 'string');
        $this->addColumn("{{offer}}", 'body', 'text');
        $this->addColumn("{{offer}}", 'body_short', 'text');
        $this->addColumn("{{offer}}", 'image', 'string');
        $this->addColumn("{{offer}}", 'image_bg', 'string');
    }
}
