<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DB_DSN'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCacheExclude' => [],
    'schemaCache' => 'cache',
    'queryCache' => 'cache',
    'enableLogging' => YII_DEBUG,
    'enableProfiling' => YII_DEBUG,
];
