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
class m000000_000000_offer_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{offer}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id' => "integer NOT NULL",
                'update_user_id' => "integer NOT NULL",
                'create_time'    => 'datetime NOT NULL',
                'update_time'    => 'datetime NOT NULL',
            ],
            $this->getOptions()
        );

        //ix
        $this->createIndex("ix_{{offer}}_create_user", '{{offer}}', "create_user_id", false);
        $this->createIndex("ix_{{offer}}_update_user", '{{offer}}', "update_user_id", false);
        $this->createIndex("ix_{{offer}}_create_time", '{{offer}}', "create_time", false);
        $this->createIndex("ix_{{offer}}_update_time", '{{offer}}', "update_time", false);

    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{offer}}');
    }
}
