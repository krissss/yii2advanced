<?php

return [
    // 模拟网页授权登录，非微信开发者工具测试时可以打开
    'wechatMpMockLogin' => get_env('WX_MP_MOCK_LOGIN', false),
    'wechatMpMockLoginId' => get_env('WX_MP_MOCK_LOGIN_ID', 1),
    // 是否允许 JSSDK 签名，未绑定接口调用 ip 时可以关闭
    'wechatJSSDKEnable' => get_env('ENABLE_JSSDK_CONFIG', true),
    // @see https://www.easywechat.com/docs/4.x/official-account/configuration
    // 微信配置 具体可参考EasyWechat
    'wechatConfig' => [
        'app_id' => get_env('WX_APP_ID'),
        'secret' => get_env('WX_SECRET'),
    ],
    // 微信支付配置 具体可参考EasyWechat
    'wechatPaymentConfig' => [
        'app_id' => get_env('WX_APP_ID'),
        'mch_id' => get_env('WX_MCH_ID'),
        'key' => get_env('WX_MCH_KEY'),
        //'cert_path' => Yii::getAlias(get_env('WX_MCH_CERT_PATH')),
        //'key_path' => Yii::getAlias(get_env('WX_MCH_KEY_PATH')),
    ],
    // 微信小程序配置 具体可参考EasyWechat
    'wechatMiniProgramConfig' => [
        'app_id' => get_env('WX_MINI_APP_ID'),
        'secret' => get_env('WX_MINI_SECRET'),
    ],
    // 微信开放平台第三方平台配置 具体可参考EasyWechat
    'wechatOpenPlatformConfig' => [],
    // 微信企业微信配置 具体可参考EasyWechat
    'wechatWorkConfig' => [],
    // 微信企业微信开放平台 具体可参考EasyWechat
    'wechatOpenWorkConfig' => [],
    // 微信小微商户 具体可参考EasyWechat
    'wechatMicroMerchantConfig' => [],
];
