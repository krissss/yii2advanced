<?php

use common\components\Logger;
use kriss\messages\I18NHelper;
use yii\helpers\ArrayHelper;

$db = require __DIR__ . '/db.php';
$redis = require __DIR__ . '/redis.php';
$params = require __DIR__ . '/params.php';
$assetManager = require __DIR__ . '/asset-manager.php';
$extendComponents = require __DIR__ . '/extend-components.php';

return [
    'name' => 'APP',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'aliases' => [
        '@bower' => '@project/node_modules',
        '@npm' => '@project/node_modules',
    ],
    'params' => $params,
    'components' => ArrayHelper::merge([
        'db' => $db,
        'sessionRedis' => array_merge($redis, [
            'database' => get_env('RDB_DB_SESSION'),
        ]),
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => 'cacheRedis',
            'defaultDuration' => 3600,
        ],
        'cacheRedis' => array_merge($redis, [
            'database' => get_env('RDB_DB_CACHE'),
        ]),
        'log' => [
            'targets' => Logger::getCommonYiiLogTargets(),
        ],
        'assetManager' => $assetManager,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
                'yii2mod.settings' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/settings/messages',
                ],
                'kriss' => I18NHelper::getKrissMessageConfig(),
            ]
        ]
    ], $extendComponents),
];
