<?php

namespace api\controllers;

use api\components\BaseApiController;
use api\forms\LoginForm;
use api\forms\RegisterForm;
use kriss\actions\rest\crud\CommonFormAction;

class AuthController extends BaseApiController
{
    public $postVerbActions = ['login', 'register'];

    public function actions()
    {
        $actions = parent::actions();

        // 登录
        $actions['login'] = [
            'class' => CommonFormAction::class,
            'modelClass' => LoginForm::class,
            'doMethod' => 'login',
        ];
        // 注册
        $actions['register'] = [
            'class' => CommonFormAction::class,
            'modelClass' => RegisterForm::class,
            'doMethod' => 'register',
        ];

        return $actions;
    }
}
