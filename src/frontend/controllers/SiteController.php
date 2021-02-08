<?php

namespace frontend\controllers;

use common\actions\VueAction;
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
            'example-vue' => [
                'class' => VueAction::class,
                'entry' => 'example',
                'title' => '测试'
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
