<?php

require_once __DIR__ . '/../vendor/autoload.php';

use kriss\envGenerator\Env;

return [
    'dev' => new Env([
        'desc' => '开发环境',
        'config' => [
            'docker' => [
                'app' => [
                    'appPath' => 'D:\phpStudy\WWW\yii2advanced',
                    'composerPath' => 'C:\Users\<user>\AppData\Roaming\Composer',
                ],
                'mysql' => [
                    'dataPath' => 'D:\docker\yii2advanced\mysql_data',
                    'rootPassword' => 'root@128931237',
                    'password' => 'yii2advanced@12378243',
                ],
                'redis' => [
                    'dataPath' => 'D:\docker\yii2advanced\redis_data',
                    'password' => 'yii2advanced@123324',
                ],
            ],
            'project' => [
                'yiiDebug' => 1,
                'yiiEnv' => 'dev',
                'cookieKey' => 'jjkj1kj3j1239890aksdqwe',
            ],
        ],
    ]),
    'prod' => new Env([
        'desc' => '正式环境',
        'config' => [
            'docker' => [
                'mysql' => [
                    'rootPassword' => 'root@923847213',
                    'password' => 'yii2advanced@342321113',
                ],
                'redis' => [
                    'password' => 'yii2advanced@1123324',
                ],
            ],
            'project' => [
                'cookieKey' => '12jlkjsd90898qjkl123',
            ],
        ],
    ]),
];
