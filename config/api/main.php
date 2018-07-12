<?php

$moduleName = 'api';
$cookieKey = getenv('COOKIE_KEY');

$config = [
    'id' => "app-{$moduleName}",
    'basePath' => "@{$moduleName}",
    'runtimePath' => "@runtimePath/{$moduleName}",
    'controllerNamespace' => "{$moduleName}\controllers",
    'bootstrap' => ['log'],
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'components' => [
        'request' => [
            'csrfParam' => "_csrf-{$moduleName}",
            'cookieValidationKey' => "{$moduleName}-{$cookieKey}",
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
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'identityCookie' => ['name' => "_identity-{$moduleName}", 'httpOnly' => true],
        ],
        'session' => [
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
}

return $config;
