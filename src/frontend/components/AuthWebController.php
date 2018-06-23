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
            'class' => UserLoginFilter::class,
        ];
        $behaviors['user_status'] = [
            'class' => UserStatusFilter::class,
            'notAllowedStatus' => [User::STATUS_DISABLE],
            'errorMessage' => '用户被锁定，不能执行操作'
        ];

        return $behaviors;
    }
}