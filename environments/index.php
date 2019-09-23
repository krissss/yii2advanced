<?php

$writablePath = [
    'runtime',
    'public/assets',
];

$setExecutablePath = [
    'yii',
];

$envConf = require __DIR__ . '/generate-config/env-conf.php';
$envArr = [];
foreach ($envConf as $env => $conf) {
    /** @var $conf \kriss\envGenerator\Env */
    $envArr[$env] = $env;
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
