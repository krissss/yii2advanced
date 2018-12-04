<?php

use common\components\EnvGenerator;
use kriss\envGenerator\Env;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require_once __DIR__ . '/../config/common/bootstrap.php';

(new EnvGenerator([
    'generateFilePath' => __DIR__,
    'baseEnv' => new Env([
        'desc' => '基础配置',
        'config' => [
            'docker' => [
                'app' => [
                    'name' => 'app',
                    'image' => 'daocloud.io/krissss/docker-yii2_71',
                    'version' => 'v1.6-unzip',
                    'port' => 10080,
                    'appPath' => '/app/yii2advanced',
                    'composerPath' => '~/.composer',
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
                    'dataPath' => '/mnt/yii2advanced/mysql_data',
                    'port' => 13306,
                    'rootPassword' => 'root@123892342',
                    'database' => 'yii2advanced',
                    'user' => 'yii2advanced',
                    'password' => 'yii2advanced@89024',
                ],
                'redis' => [
                    'use' => true,
                    'name' => 'redis',
                    'image' => 'redis',
                    'version' => '3.2',
                    'dataPath' => '/mnt/yii2advanced/redis_data',
                    'port' => 16379,
                    'bind' => '0.0.0.0',
                    'password' => 'yii2advanced@1238982324',
                ]
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
                    'dbSession' => '10',
                    'dbCache' => '11',
                ],
                'components' => [
                ]
            ],
        ],
    ]),
    'envConf' => require __DIR__ . '/env-conf.php'
]))->run();
