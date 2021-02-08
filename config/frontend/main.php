<?php

use common\components\Request;

$moduleName = 'frontend';
$cookieKey = get_env('COOKIE_KEY');

$config = [
    'id' => "app-{$moduleName}",
    'basePath' => "@{$moduleName}",
    'runtimePath' => "@runtimePath/{$moduleName}",
    'controllerNamespace' => "{$moduleName}\controllers",
    'bootstrap' => [
        'log',
        function () {
            Yii::setAlias('@public', Yii::getAlias('@web'));
        }
    ],
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'components' => [
        'request' => [
            'class' => Request::class,
            'csrfParam' => "_csrf-{$moduleName}",
            'cookieValidationKey' => "{$moduleName}-{$cookieKey}",
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'identityCookie' => ['name' => "_identity-{$moduleName}", 'httpOnly' => true],
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => 'sessionRedis',
            'name' => "_session-{$moduleName}",
            'timeout' => 86400,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
];

if (YII_ENV === 'dev') {
    require __DIR__ . '/../common/modules/debug.php';
    require __DIR__ . '/../common/modules/gii.php';
}

return $config;
