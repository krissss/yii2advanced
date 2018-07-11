<?php

namespace api\controllers;

use api\components\BaseRestController;
use api\models\form\LoginForm;
use api\models\form\RegisterForm;
use kriss\actions\rest\crud\CommonFormAction;
use kriss\behaviors\rest\PostVerbFilter;

class AuthController extends BaseRestController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'postVerbFilter' => [
                'class' => PostVerbFilter::class,
                'actions' => ['login', 'register']
            ]
        ]);
    }

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
