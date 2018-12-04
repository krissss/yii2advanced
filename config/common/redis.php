<?php

$password = getenv('REDIS_PASSWORD');
$redisConf = [
    'class' => 'yii\redis\Connection',
    'hostname' => getenv('REDIS_HOST'),
    'port' => getenv('REDIS_PORT'),
    'database' => 0,
];
if ($password) {
    $redisConf['password'] = $password;
}
return $redisConf;
