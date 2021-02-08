<?php

namespace common\models\base;

use Overtrue\Socialite\User;

interface WechatUserInterface
{
    /**
     * 绑定微信信息，一般逻辑为：
     * 根据 openid 判断是否存在，不存在插入，存在则直接返回（或更新某些字段）
     * @param User $user
     * @return static
     */
    public static function bindByWechat(User $user): self;

    /**
     * 更新 access_token 字段，返回更新后的 access_token
     * @return string
     */
    public function updateAccessToken(): string;
}
