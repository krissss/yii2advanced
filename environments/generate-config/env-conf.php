<?php

require_once __DIR__ . '/config.php';

return [
    'dev' => [
        'desc' => '开发环境',
        'config' => [
            'docker' => [
                'app' => [
                    'appPath' => $devAppPath,
                    'port' => $devPortApp,
                    'composerPath' => $devComposerPath,
                    'phpConf' => 'dev',
                ],
                'mysql' => [
                    'port' => $devPortMysql,
                    'dataPath' => "{$devDataPath}\\{$appName}\\mysql_data",
                    'rootPassword' => 'root@128931237',
                    'password' => "{$appName}@12378243",
                ],
                'redis' => [
                    'port' => $devPortRedis,
                    'dataPath' => "{$devDataPath}\\{$appName}\\redis_data",
                    'password' => "{$appName}@123324",
                ],
            ],
            'project' => [
                'yiiDebug' => 1,
                'yiiEnv' => 'dev',
                'cookieKey' => 'jjkj1kj3j1239890aksdqwe',
            ],
        ],
    ],
    'prod' => [
        'desc' => '正式环境',
        'config' => [
            'docker' => [
                'mysql' => [
                    'rootPassword' => 'root@923847213',
                    'password' => "{$appName}@342321113",
                ],
                'redis' => [
                    'password' => "{$appName}@1123324",
                ],
            ],
            'project' => [
                'cookieKey' => '12jlkjsd90898qjkl123',
            ],
        ],
    ],
];
