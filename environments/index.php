<?php

$writablePath = [
    'runtime',
    'public/admin/assets',
    'public/api/assets',
];

$setExecutablePath = [
    'yii',
];

$envConf = require __DIR__ . '/env-conf.php';
$envArr = [];
foreach ($envConf as $env => $conf) {
    /** @var $conf \kriss\envGenerator\Env */
    $envArr[$conf->desc] = $env;
}

$config = [];
foreach ($envArr as $name => $path) {
    $config[$name] = [
        'path' => $path,
        'setWritable' => $writablePath,
        'setExecutable' => $setExecutablePath,
    ];
}

return $config;
