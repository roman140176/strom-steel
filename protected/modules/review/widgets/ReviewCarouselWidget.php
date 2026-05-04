<?php
/**
 * ReviewCarouselWidget — Swiper-карусель опубликованных отзывов
 *
 * Использование:
 *   $this->widget('application.modules.review.widgets.ReviewCarouselWidget', [
 *       'limit' => 9,
 *       'order' => 'ASC', // или 'DESC' (по умолчанию)
 *   ]);
 */
Yii::import('application.modules.review.models.Review');

class ReviewCarouselWidget extends yupe\widgets\YWidget
{
    public $limit = 9;
    public $order = 'DESC';
    public $view = 'carousel';

    public function run()
    {
        $direction = strtoupper((string)$this->order) === 'ASC' ? 'ASC' : 'DESC';

        $criteria = new CDbCriteria();
        $criteria->addCondition('t.moderation = :moderation');
        $criteria->params[':moderation'] = Review::STATUS_PUBLIC;
        $criteria->order = "t.position {$direction}, t.date_created {$direction}";
        $criteria->limit = (int)$this->limit;

        $reviews = Review::model()->findAll($criteria);

        if (empty($reviews)) {
            return;
        }

        $this->render($this->view, [
            'reviews' => $reviews,
        ]);
    }
}
