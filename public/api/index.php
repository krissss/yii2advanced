<?php
require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

require __DIR__ . '/../../config/common/bootstrap-env.php';

defined('YII_DEBUG') or define('YII_DEBUG', get_env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', get_env('YII_ENV'));

require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../config/common/bootstrap.php';
require __DIR__ . '/../../config/api/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../config/common/main.php',
    require __DIR__ . '/../../config/api/main.php'
);

(new yii\web\Application($config))->run();
