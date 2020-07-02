<?php

$password = get_env('RDB_PASSWORD');
$redisConf = [
    'class' => 'yii\redis\Connection',
    'hostname' => get_env('RDB_HOST'),
    'port' => get_env('RDB_PORT'),
    //'database' => 0,
];
if ($password) {
    $redisConf['password'] = $password;
}
return $redisConf;
