<?php

if (!function_exists('get_env')) {
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
}

if (!function_exists('start_web_app')) {
    /**
     * 启动 web 应用
     * @param $name
     * @throws \yii\base\InvalidConfigException
     */
    function start_web_app($name)
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        defined('YII_DEBUG') or define('YII_DEBUG', get_env('YII_DEBUG'));
        defined('YII_ENV') or define('YII_ENV', get_env('YII_ENV'));

        require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
        require __DIR__ . '/../config/common/bootstrap.php';
        require __DIR__ . '/../config/' . $name . '/bootstrap.php';

        $config = yii\helpers\ArrayHelper::merge(
            require __DIR__ . '/../config/common/main.php',
            require __DIR__ . '/../config/' . $name . '/main.php'
        );

        (new yii\web\Application($config))->run();
    }
}
