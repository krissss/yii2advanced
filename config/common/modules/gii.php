<?php
/**
 * @var array $config
 */

$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    'allowedIPs' => ['127.0.0.1', '::1', '192.168.*', '172.*', '10.*'],
    'generators' => [
        'Kriss Auth' => [
            'class' => \kriss\modules\auth\generators\Generator::class,
        ],
        'kriss Dynagrid' => [
            'class' => \kriss\generators\dynagrid\Generator::class,
        ],
        'kriss Crud' => [
            'class' => \kriss\generators\crud\Generator::class,
        ],
    ],
];
