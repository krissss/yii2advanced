<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('BD_DSN'),
    'username' => getenv('BD_USERNAME'),
    'password' => getenv('BD_PASSWORD'),
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCacheExclude' => [],
    'schemaCache' => 'cache',
    'queryCache' => 'cache',
];