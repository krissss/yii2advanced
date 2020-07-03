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
                '@app/migrations',
                '@vendor/yii2mod/yii2-settings/migrations',
            ]
        ],
    ],
    'components' => [
    ],
];
