<?php

use common\models\base\ConfigString;

$config = [
    'id' => 'app-frontend',
    'basePath' => '@frontend',
    'runtimePath' => '@runtime/frontend',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => getenv('COOKIE_KEY_FRONTEND'),
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if($response->data !== null && is_array($response->data)){
                    $response->data = array_merge([
                        'status' => $response->statusCode,
                        'message' => $response->statusText,
                    ], $response->data);
                    $response->statusCode = 200;
                }
            },
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'front-session',
            'class' => 'yii\redis\Session',
            'redis' => ConfigString::COMPONENT_SESSION_REDIS,
            'keyPrefix' => 'app_fs_',
            'timeout' => 3 * 3600
        ],
        'log' => [
            //'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
];

if (YII_ENV === 'dev') {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*', '172.*', '10.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*', '172.*', '10.*'],
        'generators' => [
            'Kriss Auth' => [
                'class' => \kriss\modules\auth\generators\Generator::class,
            ],
            'kriss Dynagrid' => [
                'class' => \kriss\generators\dynagrid\Generator::class
            ],
        ]
    ];
}

return $config;
