<?php

namespace admin\controllers;

use admin\components\AuthWebController;
use common\actions\SettingAction;
use common\models\settings\SettingApp;

class SettingController extends AuthWebController
{
    public function actions()
    {
        $actions = parent::actions();

        $actions['app'] = [
            'class' => SettingAction::class,
            'modelClass' => SettingApp::class,
            'view' => 'app',
            'successMessage' => '修改成功',
        ];

        return $actions;
    }
}
