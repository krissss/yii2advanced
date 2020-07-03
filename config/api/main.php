<?php

use api\components\ApiResponse;
use common\components\Request;

$moduleName = 'api';
$cookieKey = get_env('COOKIE_KEY');

$config = [
    'id' => "app-{$moduleName}",
    'basePath' => "@{$moduleName}",
    'runtimePath' => "@runtimePath/{$moduleName}",
    'controllerNamespace' => "{$moduleName}\controllers",
    'bootstrap' => [
        'log',
        function () {
            Yii::setAlias('@public', Yii::getAlias('@web/../'));
        }
    ],
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'components' => [
        'request' => [
            'class' => Request::class,
            'csrfParam' => "_csrf-{$moduleName}",
            'cookieValidationKey' => "{$moduleName}-{$cookieKey}",
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class' => ApiResponse::class,
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'identityCookie' => ['name' => "_identity-{$moduleName}", 'httpOnly' => true],
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => 'sessionRedis',
            'name' => "_session-{$moduleName}",
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
    ];
}

return $config;
