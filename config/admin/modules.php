<?php

use common\components\Logger;
use common\models\base\ConfigString;
use \kartik\datecontrol\Module as DateControlModule;

$logReaderCategories = [
    ConfigString::CATEGORY_NEED_SOLVED,
    ConfigString::CATEGORY_QUEUE_JOB,
];
$moreLogReaderAliases = [];
foreach ($logReaderCategories as $logReaderCategory) {
    $moreLogReaderAliases[$logReaderCategory] = Logger::getCommonLogDir($logReaderCategory, true);
}

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
        'class' => \kriss\modules\auth\Module::class,
        'as user_login' => \kriss\behaviors\web\UserLoginFilter::class,
        'as iframe_layout' => [
            'class' => \kriss\iframeLayout\IframeLinkFilter::class,
            'layout' => '@app/views/layouts/main-content'
        ],
        'skipAuthOptions' => []
    ],
    'log-reader' => [
        'class' => 'kriss\logReader\Module',
        'as login_filter' => \kriss\behaviors\web\UserLoginFilter::class,
        'aliases' => array_merge([
            'frontend' => '@frontend/runtime/logs/app.log',
            'backend' => '@backend/runtime/logs/app.log',
            'console' => '@console/runtime/logs/app.log',
        ], $moreLogReaderAliases),
    ],
];
