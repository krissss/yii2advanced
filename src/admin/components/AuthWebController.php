<?php

namespace admin\components;

use kriss\behaviors\web\UserLoginFilter;
use kriss\behaviors\web\UserStatusFilter;
use common\models\Admin;

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
            'notAllowedStatus' => [Admin::STATUS_DISABLE],
            'errorMessage' => '用户被锁定，不能执行操作'
        ];

        return $behaviors;
    }
}
