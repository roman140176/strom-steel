<?php

/**
 * m000000_000000_page_base install migration
 * Класс миграций для модуля Page:
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.install.migrations
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @since 1.0
 *
 */
class m161028_090209_add_page_image_tbl extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{page_page_image}}',
            [
                'id'             => 'pk',
                'page_id'    => 'integer DEFAULT NULL',
                'name'       => 'varchar(250) NOT NULL',
                'title'    => 'varchar(250) NOT NULL',
            ],
            $this->getOptions()
        );
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys("{{page_page_image}}");
    }
}
