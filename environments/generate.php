<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require_once __DIR__ . '/../config/common/bootstrap.php';

$generateConfigPath = __DIR__ . '/generate-config/';
require $generateConfigPath . 'EnvGenerator.php';

(new \EnvGenerator([
    'generateFilePath' => __DIR__,
    'baseEnv' => require $generateConfigPath . 'env-base.php',
    'envConf' => require $generateConfigPath . 'env-conf.php',
]))->run();
