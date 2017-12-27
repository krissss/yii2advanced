<?php

use common\models\Admin;
use common\models\base\ConfigString;
use \kartik\datecontrol\Module as DateControlModule;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
            'defaultTheme' => 'panel-primary',
            'cookieSettings' => ['httpOnly' => true, 'expire' => time() + 100 * 24 * 3600],
            'defaultPageSize' => 20,
            'minPageSize' => 5,
            'maxPageSize' => 200,
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            'displaySettings' => [
                DateControlModule::FORMAT_DATE => 'php:Y-m-d',
                DateControlModule::FORMAT_TIME => 'php:H:i:s',
                DateControlModule::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            'saveSettings' => [
                DateControlModule::FORMAT_DATE => 'php:U',
                DateControlModule::FORMAT_TIME => 'php:U',
                DateControlModule::FORMAT_DATETIME => 'php:U',
            ],
            'displayTimezone' => 'PRC',
            'saveTimezone' => 'UTC',
            'autoWidget' => true,
            'autoWidgetSettings' => [
                DateControlModule::FORMAT_DATE => [
                    'type' => 1,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'weekStart' => 1,
                        'todayHighlight' => true,
                    ]
                ],
                DateControlModule::FORMAT_TIME => [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'showSeconds' => true,
                    ]
                ],
                DateControlModule::FORMAT_DATETIME => [
                    'type' => 1,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'weekStart' => 1,
                        'todayHighlight' => true,
                    ],
                ],
            ],
        ],
        'auth' => [
            'class' => \kriss\modules\auth\Module::className(),
            'as user_login' => \kriss\behaviors\web\UserLoginFilter::className(),
            'as iframe_layout' => [
                'class' => \kriss\iframeLayout\IframeLinkFilter::className(),
                'layout' => '@app/views/layouts/main-content'
            ],
            'skipAuthOptions' => []
        ],
        'log-reader' => [
            'class' => 'kriss\logReader\Module',
            'as login_filter' => \kriss\behaviors\web\UserLoginFilter::className(),
            'aliases' => [
                'frontend' => '@frontend/runtime/logs/app.log',
                'backend' => '@backend/runtime/logs/app.log',
                'console' => '@console/runtime/logs/app.log',
                'needSolved' => '@common/runtime/logs/needSolved/needSolved.log',
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'class' => \kriss\modules\auth\components\User::className(),
            'authClass' => \common\models\base\Auth::className(),
            'identityClass' => Admin::className(),
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'back-session',
            'class' => 'yii\redis\Session',
            'redis' => ConfigString::COMPONENT_SESSION_REDIS,
            'keyPrefix' => 'app_bs_',
            'timeout' => 6 * 3600
        ],
        'log' => [
            //'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
            ],
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
    ],
    'params' => $params,
];
