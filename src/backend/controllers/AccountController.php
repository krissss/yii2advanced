<?php

namespace backend\controllers;

use backend\components\AuthWebController;
use backend\models\form\ModifyPasswordForm;
use kriss\actions\web\crud\CommonFormAction;

class AccountController extends AuthWebController
{
    public function actions()
    {
        $actions = parent::actions();

        // 修改密码
        $actions['modify-password'] = [
            'class' => CommonFormAction::class,
            'modelClass' => ModifyPasswordForm::class,
            'doMethod' => 'modifyPassword',
            //'view' => 'modify-password',
            'operateMsg' => '修改密码',
            'successRedirect' => ['/site/login']
        ];

        return $actions;
    }
}
