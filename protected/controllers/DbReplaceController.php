<?php
namespace application\controllers;

use yupe\components\controllers\FrontController;
use application\components\DbReplaceService;

class DbReplaceController extends FrontController
{
    public function actionIndex()
    {
        exit;
        $request = \Yii::app()->request;
        $from = '';
        $to = '';
        $dryRun = true;
        $result = null;
        if ($request->getIsPostRequest()) {
            $from = (string)$request->getPost('from', '');
            $to = (string)$request->getPost('to', '');
            $dryRun = (bool)$request->getPost('dryRun', 0);
            if ($from !== '') {
                $service = new DbReplaceService();
                $result = $service->run($from, $to, $dryRun);
            }
        }
        $this->render('index', [
            'from' => $from,
            'to' => $to,
            'dryRun' => $dryRun,
            'result' => $result,
        ]);
    }
}
