<?php

require_once __DIR__ . '/config.php';

return [
    'desc' => '基础配置',
    'config' => [
        'docker' => [
            'app' => [
                'name' => 'app',
                'image' => 'daocloud.io/krissss/docker-yii2_71',
                'version' => 'v1.9',
                'port' => $prodPortApp,
                'appPath' => "{$prodAppPath}/{$appName}",
                'composerPath' => $prodComposerPath,
                'hasNginxConf' => true,
                'hasPhpConf' => true,
                'hasSupervisorConf' => false,
            ],
            'mysql' => [
                'use' => true,
                'name' => 'mysql',
                'image' => 'mysql',
                'version' => '5.7',
                'hasMysqlConf' => true,
                'dataPath' => "{$prodDataPath}/{$appName}/mysql_data",
                'port' => $prodPortMysql,
                'rootPassword' => 'root@123892342',
                'database' => $appName,
                'user' => $appName,
                'password' => "{$appName}@89024",
            ],
            'redis' => [
                'use' => true,
                'name' => 'redis',
                'image' => 'redis',
                'version' => '3.2',
                'dataPath' => "{$prodDataPath}/{$appName}/redis_data",
                'port' => $prodPortRedis,
                'bind' => '0.0.0.0',
                'password' => "{$appName}@$123898902",
            ],
        ],
        'project' => [
            'yiiDebug' => 0,
            'yiiEnv' => 'prod',
            'cookieKey' => 'suibianshuru',
            'db' => [
                'dsn' => 'mysql:host=${docker.mysql.name};port=3306;dbname=${docker.mysql.database}',
                'username' => '${docker.mysql.user}',
                'password' => '${docker.mysql.password}',
            ],
            'redis' => [
                'host' => '${docker.redis.name}',
                'port' => '6379',
                'password' => '${docker.redis.password}',
                'dbSession' => '0',
                'dbCache' => '1',
            ],
        ],
    ],
];
