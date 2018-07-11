<?php

namespace api\components;

use common\models\User;
use kriss\behaviors\rest\QueryParamAuth;

class AuthRestController extends BaseRestController
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
            'class' => QueryParamAuth::class,
            'tokenParam' => self::TOKEN_PARAM,
            'only' => $this->authOnly,
            'except' => $this->authExcept,
        ];
        $behaviors['user_status'] = [
            'class' => UserStatusFilter::class,
            'notAllowedStatus' => [User::STATUS_DISABLE],
            'errorMessage' => '用户被禁止操作',
            'only' => $this->authOnly,
            'except' => $this->authExcept,
        ];

        return $behaviors;
    }
}
