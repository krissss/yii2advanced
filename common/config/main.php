<?php
return [
    'name' => 'APP',
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:401'
                    ]
                ],
            ]
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'hashCallback' => function ($path) {
                return hash('md4', $path);
            },
            // 使用外部静态资源加速的项目
            // 如果 cdn 挂了可以直接全部注释掉
            // 所以请在原 XXXAsset 下写上本项目中存在的资源
            'bundles' => YII_DEBUG ? [] : require (__DIR__ . '/cdn-staticfile.php'),
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'bearyChat' => [
            'class' => 'kriss\bearyChat\Incoming',
            'clients' => [
                'default' => [
                    'webhook' => 'https://hook.bearychat.com/=bw8GL/incoming/2fb41dadeea22585340549ec6930face',
                    'message_defaults' => [
                        'attachment_color' => '#f5f5f5',
                    ]
                ],
            ]
        ],
    ],
];
