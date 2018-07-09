<?php

namespace common\components;

use common\models\base\ConfigString;
use Yii;
use yii\helpers\Json;

class Logger
{
    /**
     * 记录必须解决的日志
     * @param $msg
     * @param string $type
     */
    public static function needSolved($msg, $type = 'info')
    {
        static::write($msg, $type, ConfigString::CATEGORY_NEED_SOLVED);
    }

    /**
     * 记录轮询脚本的日志
     * @param $msg
     * @param string $type
     */
    public static function queueJob($msg, $type = 'info')
    {
        static::write($msg, $type, ConfigString::CATEGORY_QUEUE_JOB);
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
     * @return string
     */
    public static function getCommonLogDir($category)
    {
        $date = date('Ymd');
        return "@runtimePath/common/logs/{$category}/{$category}.log.{$date}";
    }
}
