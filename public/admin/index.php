<?php

require __DIR__ . '/../../config/common/bootstrap.php';
require __DIR__ . '/../../config/admin/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../config/common/main.php',
    require __DIR__ . '/../../config/admin/main.php'
);

(new yii\web\Application($config))->run();
