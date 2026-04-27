<?php
/**
* Класс SitemapExceptionBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://yupe.ru
**/
class SitemapExceptionBackendController extends \yupe\components\controllers\BackController
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'SitemapException',
                'validAttributes' => ['exception_url', 'status'],
            ],
        ];
    }

    /**
    * Отображает Список исключений по указанному идентификатору
    *
    * @param integer $id Идинтификатор Список исключений для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Списка исключений.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new SitemapException;

        if (Yii::app()->getRequest()->getPost('SitemapException') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('SitemapException'));
        
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('SitemapModule.sitemap', 'Запись добавлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('create', ['model' => $model]);
    }
    
    /**
    * Редактирование Списка исключений.
    *
    * @param integer $id Идинтификатор Список исключений для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('SitemapException') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('SitemapException'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('SitemapModule.sitemap', 'Запись обновлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('update', ['model' => $model]);
    }
    
    /**
    * Удаляет модель Списка исключений из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Списка исключений, который нужно удалить
    *
    * @return void
    */
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();

            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('SitemapModule.sitemap', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('SitemapModule.sitemap', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление Списками исключений.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new SitemapException('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('SitemapException') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('SitemapException'));
        $this->render('index', ['model' => $model]);
    }
    
    /**
    * Возвращает модель по указанному идентификатору
    * Если модель не будет найдена - возникнет HTTP-исключение.
    *
    * @param integer идентификатор нужной модели
    *
    * @return void
    */
    public function loadModel($id)
    {
        $model = SitemapException::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('SitemapModule.sitemap', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
