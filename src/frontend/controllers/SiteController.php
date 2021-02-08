<?php

namespace frontend\controllers;

use frontend\components\BaseWebController;
use kriss\actions\rest\ErrorAction;
use kriss\actions\rest\OfflineAction;

class SiteController extends BaseWebController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'offline' => [
                'class' => OfflineAction::class,
            ],
        ];
    }

    public function actionIndex()
    {
        return 'welcome';
    }

    public function actionLogin()
    {
        return 'need-login';
    }
}
