<?php

$password = getenv('RDB_PASSWORD');
$redisConf = [
    'class' => 'yii\redis\Connection',
    'hostname' => getenv('RDB_HOST'),
    'port' => getenv('RDB_PORT'),
    //'database' => 0,
];
if ($password) {
    $redisConf['password'] = $password;
}
return $redisConf;
