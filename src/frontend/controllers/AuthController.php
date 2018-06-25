<?php

namespace frontend\controllers;

use frontend\components\BaseRestController;
use frontend\models\form\LoginForm;
use frontend\models\form\RegisterForm;
use kriss\behaviors\rest\PostVerbFilter;
use Yii;

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

    // 登录
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            $user = $model->login();
            if ($user) {
                return $user;
            }
        }
        return $model;
    }

    // 注册
    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            $user = $model->register();
            if ($user) {
                return $user;
            }
        }
        return $model;
    }
}
