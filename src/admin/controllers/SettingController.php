<?php

namespace admin\controllers;

use admin\components\AuthWebController;
use common\models\settings\SettingApp;
use yii2mod\settings\actions\SettingsAction;

class SettingController extends AuthWebController
{
    public function actions()
    {
        $actions = parent::actions();

        $actions['app'] = [
            'class' => SettingsAction::class,
            'modelClass' => SettingApp::class,
            'view' => 'app',
            'successMessage' => '修改成功',
        ];

        return $actions;
    }
}
