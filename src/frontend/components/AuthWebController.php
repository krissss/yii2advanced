<?php

namespace frontend\components;

use common\enums\UserStatus;
use kriss\behaviors\web\UserLoginFilter;
use kriss\behaviors\web\UserStatusFilter;

abstract class AuthWebController extends BaseWebController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['user_login'] = [
            'class' => UserLoginFilter::class,
        ];
        $behaviors['user_status'] = [
            'class' => UserStatusFilter::class,
            'notAllowedStatus' => [UserStatus::DISABLE],
            'errorMessage' => '用户被锁定，不能执行操作',
        ];

        return $behaviors;
    }
}
