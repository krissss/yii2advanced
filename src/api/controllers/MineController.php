<?php

namespace api\controllers;

use api\components\AuthApiController;
use Yii;

class MineController extends AuthApiController
{
    // 个人信息
    public function actionInfo()
    {
        return Yii::$app->user->identity;
    }
}
