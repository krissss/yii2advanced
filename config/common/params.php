<?php

use common\components\Params;

$params = Params::loadFromEnv();

if (class_exists('jianyan\easywechat\Wechat')) {
    $params = array_merge($params, require __DIR__ . '/params/wechat.php');
}

return $params;
