<?php

namespace api\controllers;

use api\components\BaseRestController;
use kriss\actions\rest\ErrorAction;
use kriss\actions\rest\OfflineAction;

class SiteController extends BaseRestController
{
    /**
     * @inheritdoc
     */
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
