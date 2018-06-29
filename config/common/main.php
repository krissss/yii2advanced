<?php

use yii\helpers\ArrayHelper;

$db = require __DIR__ . '/db.php';
$logs = require __DIR__ . '/logs.php';
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
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => ArrayHelper::merge([
        'db' => $db,
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtimePath/common/cache'
        ],
        'log' => $logs,
        'assetManager' => $assetManager,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ], $extendComponents),
];
