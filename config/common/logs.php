<?php

use common\components\Logger;
use common\models\base\ConfigString;

function getLogFileConfig($category)
{
    return [
        'class' => 'yii\log\FileTarget',
        'categories' => [$category],
        'logVars' => [],
        'logFile' => Logger::getCommonLogDir($category),
        'maxLogFiles' => 31,
        'dirMode' => 0777
    ];
}

return [
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
            'except' => [
                'yii\web\HttpException:401'
            ]
        ],
        // 记录必须解决的错误的日志
        getLogFileConfig(ConfigString::CATEGORY_NEED_SOLVED),
        // 记录轮询操作的日志
        getLogFileConfig(ConfigString::CATEGORY_QUEUE_JOB),
    ]
];
