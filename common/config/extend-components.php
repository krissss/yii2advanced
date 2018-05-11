<?php

use common\models\base\ConfigString;

return [
    ConfigString::COMPONENT_REDIS => [
        'class' => 'yii\redis\Connection',
        'hostname' => getenv('REDIS_HOSTNAME'),
        'port' => getenv('REDIS_PORT'),
        'password' => getenv('REDIS_PASSWORD') ?: null,
        'database' => getenv('REDIS_DATABASE'),
    ],
    ConfigString::COMPONENT_SESSION_REDIS => [
        'class' => 'yii\redis\Connection',
        'hostname' => getenv('REDIS_HOSTNAME'),
        'port' => getenv('REDIS_PORT'),
        'password' => getenv('REDIS_PASSWORD') ?: null,
        'database' => getenv('REDIS_SESSION_DATABASE'),
    ],
    ConfigString::COMPONENT_CACHE_REDIS => [
        'class' => 'yii\redis\Connection',
        'hostname' => getenv('REDIS_HOSTNAME'),
        'port' => getenv('REDIS_PORT'),
        'password' => getenv('REDIS_PASSWORD') ?: null,
        'database' => getenv('REDIS_CACHE_DATABASE'),
    ],
    ConfigString::COMPONENT_QI_NIU => [
        'class' => \common\components\QiNiu::class,
        'access_key' => getenv('QN_AK'),
        'secret_key' => getenv('QN_SK'),
        'bucket' => getenv('QN_BUCKET'),
        'domain' => getenv('QN_DOMAIN'),
        'savePath' => getenv('QN_SAVE_PATH')
    ],
];