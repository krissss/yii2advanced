<?php

namespace common\components;

class AES extends \kriss\tools\AES
{
    protected static function getKEY()
    {
        // 生成方式：base64_encode(openssl_random_pseudo_bytes(32));
        return base64_decode('ZULnwdUJGWoX0OPJFdgYfM1zEJNaSSP6+etzAX1lVPE=');
    }

    protected static function getIV()
    {
        // 生成方式：base64_encode(openssl_random_pseudo_bytes(16));
        return base64_decode('GXo1x3fsrl6k0uAODL5HBg==');
    }
}