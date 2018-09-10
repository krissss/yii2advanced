<?php

namespace admin\components;

use common\models\enum\AdminStatus;
use kriss\behaviors\web\UserLoginFilter;
use kriss\behaviors\web\UserStatusFilter;

class AuthWebController extends BaseWebController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['admin_login'] = [
            'class' => UserLoginFilter::class,
        ];
        $behaviors['admin_status'] = [
            'class' => UserStatusFilter::class,
            'notAllowedStatus' => [AdminStatus::DISABLE],
            'errorMessage' => '用户被锁定，不能执行操作',
        ];

        return $behaviors;
    }
}
