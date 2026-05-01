<?php

/**
 * ReviewController публичный контроллер для работы со страницами
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.review.controllers
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @since 0.1
 *
 */
class ReviewController extends yupe\components\controllers\FrontController
{
    /**
     * Текущая просматриваемая страница
     */
    public $currentReview;

    /**
     * экшн для отображения конкретной страницы, отображает опубликованные страницы и превью
     */
    public function actionShow()
    {
        $dbCriteria = new CDbCriteria([
            'order'     => 't.date_created DESC',
            'condition'     => 't.moderation = 1',
        ]);


        $listperpage = $this->module->getEditableParams()['itemsperpage'];
        $itemsperpagefront = $this->module->itemsperpagefront;

        $dataProvider = new CActiveDataProvider('Review', [
            'criteria' => $dbCriteria,
            'pagination'=>[
                // 'pageSize'=>1,
                'pageSize'=>$listperpage[$itemsperpagefront],
                'pageVar' => 'page',
            ],
        ]);


        $this->render('review', ['dataProvider' => $dataProvider]);
    }
    public function actionCreate()
    {

        $model = new Review();

        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Review') !== null) {

            $model->setAttributes(Yii::app()->getRequest()->getPost('Review'));

            $model->user_id =  Yii::app()->user->id;
            $model->date_created =  date("Y-m-d H:i:s");
            if($this->module->moderation == 1){
                $model->moderation = 2;
            }
            else {
                $model->moderation = 1;
            }


            if ($model->save()) {
                Yii::app()->user->setFlash('review-success', 'Спасибо за Ваш отзыв!');

                $txt = '<b>Имя: </b>'.$model->username.'<br><b>E-mail: </b>'.$model->useremail.'<br><b>Отзыв: </b>'.$model->text;

                Yii::app()->ReviewManager->sendNotification($txt);

                $this->redirect('/review');
            }
            $this->redirect('/review');
        }


    }
    /**
     * Генерирует меню навигации по вложенным страницам для использования в zii.widgets.CBreadcrumbs
     */
    public function getBreadCrumbs()
    {
        $reviews = [];
        if ($this->currentReview->parentReview) {
            $reviews = $this->getBreadCrumbsRecursively($this->currentReview->parentReview);
        }

        $reviews = array_reverse($reviews);
        $reviews[] = $this->currentReview->title;

        return $reviews;
    }

    /**
     * Рекурсивно возвращает пригодный для zii.widgets.CBreadcrumbs массив, начиная со страницы $review
     * @param  Review $review
     * @return array
     * @internal param int $reviewId
     */
    private function getBreadCrumbsRecursively(Review $review)
    {
        $reviews = [];
        $reviews[$review->title] = $review->getUrl();
        $pp = $review->parentReview;
        if ($pp) {
            $reviews += $this->getBreadCrumbsRecursively($pp);
        }

        return $reviews;
    }
}
