<?php

use common\components\Request;
use common\models\Admin;
use kriss\iframeLayout\component\IframeMode;

$modules = require __DIR__ . '/modules.php';
$definitions = require __DIR__ . '/definitions.php';
$moduleName = 'admin';
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
    'modules' => $modules,
    'container' => [
        'definitions' => $definitions,
    ],
    'components' => [
        'request' => [
            'class' => Request::class,
            'csrfParam' => "_csrf-{$moduleName}",
            'cookieValidationKey' => "{$moduleName}-{$cookieKey}",
        ],
        'user' => [
            'class' => 'kriss\modules\auth\components\User',
            'authClass' => 'common\models\base\Auth',
            'identityClass' => Admin::class,
            'enableAutoLogin' => false,
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
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        IframeMode::COMPONENT_NAME => [
            'class' => IframeMode::class,
            'enable' => true,
            'defaultSwitch' => false,
        ],
    ],
];

if (YII_ENV === 'dev') {
    require __DIR__ . '/../common/modules/debug.php';
    require __DIR__ . '/../common/modules/gii.php';
}

return $config;
