<?php
/**
 * Виджет для отрисовки блока контента:
 *
 * @category YupeWidgets
 * @package  yupe.modules.contentblock.widgets
 * @author   Yupe Team <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @link     https://yupe.ru
 *
 **/
Yii::import('application.modules.contentblock.models.ContentBlock');
Yii::import('application.modules.contentblock.ContentBlockModule');

/**
 * Class ContentBlockWidget
 */
class ContentBlockWidget extends yupe\widgets\YWidget
{
    /**
     * @var
     */
    public $code;
    public $id;
    /**
     * @var bool
     */
    public $silent = false;
    /**
     * @var string
     */
    public $view = 'contentblock';

    /**
     * @throws CException
     */
    public function init()
    {
        if (empty($this->id)) {
            throw new CException(
                Yii::t(
                    'ContentBlockModule.contentblock',
                    'Insert content block id for ContentBlockWidget!'
                )
            );
        }

        $this->silent = (bool)$this->silent;
    }

    /**
     * @throws CException
     */
    public function run()
    {
        $cacheName = "ContentBlock{$this->id}";

        $output = Yii::app()->getCache()->get($cacheName);

        if (false === $output) {

            $block = ContentBlock::model()->findByAttributes(['id' => $this->id]);

            if (null === $block) {
                if (false === $this->silent) {
                    throw new CException(
                        Yii::t(
                            'ContentBlockModule.contentblock',
                            'Content block "{id}" was not found !',
                            [
                                '{id}' => $this->id,
                            ]
                        )
                    );
                }

                $output = '';

            } else {

                $output = $block->status == ContentBlock::STATUS_ACTIVE ? $block->getContent() : '';
            }

            Yii::app()->getCache()->set($cacheName, $output);
        }

        $this->render($this->view, ['output' => $output]);
    }
}
