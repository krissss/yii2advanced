<?php

namespace api\controllers;

use api\components\BaseApiController;
use kriss\actions\rest\ErrorAction;
use kriss\actions\rest\OfflineAction;

class SiteController extends BaseApiController
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
}
