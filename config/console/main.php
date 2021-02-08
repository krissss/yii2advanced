<?php

return [
    'id' => 'app-console',
    'basePath' => '@console',
    'runtimePath' => '@runtimePath/console',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@app/migrations', // 此目录一定放在第一个
                '@vendor/yii2mod/yii2-settings/migrations',
            ]
        ],
        'serve' => [
            'class' => 'yii\console\controllers\ServeController',
            'port' => 8089,
            'docroot' => '@project/public',
        ],
    ],
    'components' => [
    ],
];
