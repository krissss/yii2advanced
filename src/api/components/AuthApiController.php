<?php

namespace api\components;

use api\filters\UserStatusFilter;
use common\enums\UserStatus;
use kriss\behaviors\rest\HeaderParamAuth;

abstract class AuthApiController extends BaseApiController
{
    const TOKEN_PARAM = 'access-token';

    /**
     * @var array
     */
    public $authOnly = [];
    /**
     * @var array
     */
    public $authExcept = [];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // 该 key 不能更改
        $behaviors['authenticator'] = [
            'class' => HeaderParamAuth::class,
            'tokenParam' => self::TOKEN_PARAM,
            'only' => $this->authOnly,
            'except' => $this->authExcept,
        ];
        $behaviors['user_status'] = [
            'class' => UserStatusFilter::class,
            'notAllowedStatus' => [UserStatus::DISABLE],
            'errorMessage' => '用户被禁止操作',
            'only' => $this->authOnly,
            'except' => $this->authExcept,
        ];

        return $behaviors;
    }
}
