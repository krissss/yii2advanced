<?php

// 如果此处无前端，把以下注释打开
//echo 'hello-world';exit;

require __DIR__ . '/../config/common/bootstrap.php';
require __DIR__ . '/../config/frontend/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../config/common/main.php',
    require __DIR__ . '/../config/frontend/main.php'
);

(new yii\web\Application($config))->run();
