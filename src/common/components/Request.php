<?php

namespace common\components;

class Request extends \yii\web\Request
{
    /**
     * @inheritDoc
     */
    public function getUserIP()
    {
        $ip = Tools::getUserIp();
        if ($ip) {
            return $ip;
        }

        return parent::getUserIP();
    }

    /**
     * @inheritDoc
     */
    public function getIsSecureConnection()
    {
        // 若置于阿里云负载均衡SLB后端，确保勾选了SLB监听443上的 "通过X-Forwarded-Proto头字段获取SLB的监听协议"
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            return true;
        }
        return parent::getIsSecureConnection();
    }
}
