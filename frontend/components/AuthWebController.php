<?php

namespace frontend\components;

use common\models\User;
use kriss\behaviors\web\UserLoginFilter;
use kriss\behaviors\web\UserStatusFilter;

class AuthWebController extends BaseWebController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['user_login'] = [
            'class' => UserLoginFilter::className(),
        ];
        $behaviors['user_status'] = [
            'class' => UserStatusFilter::className(),
            'notAllowedStatus' => [User::STATUS_DISABLE],
            'errorMessage' => '用户被锁定，不能执行操作'
        ];

        return $behaviors;
    }
}