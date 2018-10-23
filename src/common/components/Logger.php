<?php

namespace common\components;

use Yii;
use yii\helpers\Json;

/**
 * @method static needSolve($msg, $type = 'info')
 * @method static queueJob($msg, $type = 'info')
 */
class Logger
{
    /**
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        static::write($arguments[0], isset($arguments[1]) ? $arguments[1] : 'info', $name);
    }

    /**
     * 写入日志
     * @param $msg
     * @param $type
     * @param $category
     */
    protected static function write($msg, $type, $category)
    {
        Yii::$type(is_array($msg) ? Json::encode($msg) : $msg, $category);
    }

    /**
     * 获取日志存储路径
     * @param $category
     * @param bool $noDate
     * @return string
     */
    protected static function getCommonLogDir($category, $noDate = false)
    {
        $log = "@runtimePath/common/logs/{$category}/{$category}.log";
        if ($noDate) {
            return $log;
        } else {
            $date = date('Ymd');
            return $log . ".{$date}";
        }
    }

    /**
     * log reader 组件的 aliases
     * @return array
     */
    public static function getLogReaderAliases()
    {
        $categories = LoggerCategory::getValues();
        $res = [];
        foreach ($categories as $category) {
            $res[$category] = static::getCommonLogDir($category, true);
        }
        return $res;
    }

    /**
     * yii 的 log target
     * @return array
     */
    public static function getCommonYiiLogTargets()
    {
        $categories = LoggerCategory::getValues();
        $app = [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
                'except' => [
                    'yii\web\HttpException:401',
                ],
            ]
        ];
        $others = array_map(function ($category) {
            return [
                'class' => 'yii\log\FileTarget',
                'categories' => [$category],
                'logVars' => [],
                'logFile' => Logger::getCommonLogDir($category),
                'maxLogFiles' => 31,
                'dirMode' => 0777,
            ];
        }, $categories);
        return array_merge($app, $others);
    }
}
