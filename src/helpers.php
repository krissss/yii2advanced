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
