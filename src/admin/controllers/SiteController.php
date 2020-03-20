<?php

namespace admin\controllers;

use admin\components\BaseWebController;
use admin\forms\LoginForm;
use common\models\Admin;
use kriss\actions\web\ErrorAction;
use kriss\actions\web\OfflineAction;
use kriss\iframeLayout\action\IframeModeSwitchAction;
use Yii;
use yii\filters\VerbFilter;

class SiteController extends BaseWebController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ]);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
                'layout' => 'main-login',
            ],
            'offline' => [
                'class' => OfflineAction::class,
                'layout' => 'main-login',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'offset' => 0,
                //'foreColor' => 0x000000,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            /*'iframe-mode-switch' => [
                'class' => IframeModeSwitchAction::class,
            ],*/
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['/home']);
    }

    public function actionLogin()
    {
        $this->enableCsrfValidation = true;

        $this->layout = 'main-login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            /** @var Admin|false $user */
            $user = $model->login();
            if ($user) {
                return $this->goBack();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
