<?php

require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

defined('YII_DEBUG') or define('YII_DEBUG', get_env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', get_env('YII_ENV'));

require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

$projectRoot = dirname(dirname(__DIR__));
Yii::setAlias('@project', $projectRoot . '/');
Yii::setAlias('@runtimePath', $projectRoot . '/runtime');
Yii::setAlias('@publicRoot', $projectRoot . '/public');
Yii::setAlias('@common', $projectRoot . '/src/common');
Yii::setAlias('@console', $projectRoot . '/src/console');
Yii::setAlias('@admin', $projectRoot . '/src/admin');
Yii::setAlias('@api', $projectRoot . '/src/api');
Yii::setAlias('@frontend', $projectRoot . '/src/frontend');
