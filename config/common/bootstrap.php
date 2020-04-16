<?php

/**
 * 使用 get_env 代替 getenv
 * @see https://github.com/vlucas/phpdotenv/issues/433
 * @param $key
 * @param null $defaultValue
 * @return mixed|null
 */
function get_env($key, $defaultValue = null)
{
    return $_SERVER[$key] ?? $defaultValue;
}

Yii::setAlias('@project', dirname(dirname(__DIR__)) . '/');
Yii::setAlias('@runtimePath', dirname(dirname(__DIR__)) . '/runtime');
Yii::setAlias('@publicRoot', dirname(dirname(__DIR__)) . '/public');
Yii::setAlias('@common', dirname(dirname(__DIR__)) . '/src/common');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/src/console');
Yii::setAlias('@admin', dirname(dirname(__DIR__)) . '/src/admin');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/src/api');
