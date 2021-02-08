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
            'apiFormat' => false,
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
    require __DIR__ . '/../common/modules/debug.php';
}

return $config;
