<?php

use \kartik\datecontrol\Module as DateControlModule;
use common\components\Logger;
use kriss\iframeLayout\filter\IframeLinkFilter;

return [
    'gridview' => [
        'class' => '\kartik\grid\Module',
    ],
    'dynagrid' => [
        'class' => '\kartik\dynagrid\Module',
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
                ],
            ],
            DateControlModule::FORMAT_TIME => [
                'pluginOptions' => [
                    'autoclose' => true,
                    'showSeconds' => true,
                ],
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
        'class' => \kriss\modules\auth\Module::class,
        'as user_login' => \kriss\behaviors\web\UserLoginFilter::class,
        'as iframe_layout' => [
            'class' => IframeLinkFilter::class,
            'layout' => '@app/views/layouts/main-content',
        ],
        'skipAuthOptions' => [],
    ],
    'admin-settings' => [
        'class' => 'yii2mod\settings\Module',
    ],
    'log-reader' => [
        'class' => 'kriss\logReader\Module',
        'as login_filter' => \kriss\behaviors\web\UserLoginFilter::class,
        'aliases' => array_merge([
            'api' => '@runtimePath/api/logs/app.log',
            'admin' => '@runtimePath/admin/logs/app.log',
            'console' => '@runtimePath/console/logs/app.log',
        ], Logger::getLogReaderAliases()),
    ],
];
