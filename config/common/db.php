<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => get_env('DB_DSN'),
    'username' => get_env('DB_USERNAME'),
    'password' => get_env('DB_PASSWORD'),
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCacheExclude' => [],
    'schemaCache' => 'cache',
    'queryCache' => 'cache',
    'enableLogging' => YII_DEBUG,
    'enableProfiling' => YII_DEBUG,
];
