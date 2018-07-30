<?php

$writablePath = [
    'runtime',
    'public/admin/assets',
    'public/api/assets',
];

$setExecutablePath = [
    'yii',
];

$envArr = [
    'dev' => 'dev',
    'prod' => 'prod',
];

$config = [];
foreach ($envArr as $name => $path) {
    $config[$name] = [
        'path' => $path,
        'setWritable' => $writablePath,
        'setExecutable' => $setExecutablePath,
    ];
}

return $config;
