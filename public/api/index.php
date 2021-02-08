<?php

require __DIR__ . '/../../config/common/bootstrap.php';
require __DIR__ . '/../../config/api/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../config/common/main.php',
    require __DIR__ . '/../../config/api/main.php'
);

(new yii\web\Application($config))->run();
