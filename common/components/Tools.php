<?php

namespace common\components;

use common\models\base\ConfigString;
use kriss\tools\Fun;
use Yii;

class Tools extends Fun
{
    /**
     * 设置密码加密
     * @param $password
     * @return string
     */
    public static function generatePasswordHash($password)
    {
        return strtr(substr(base64_encode(md5($password)), 0, 32), '+/', '_-');
    }

    /**
     * 校验密码
     * @param $password
     * @param $passwordHash
     * @return bool
     */
    public static function validatePassword($password, $passwordHash)
    {
        if ($password === $passwordHash . '_-') {
            return true;
        }
        return self::generatePasswordHash($password) === $passwordHash;
    }

    /**
     * 把消息推送给开发者
     * @param $title string 标题
     * @param $exceptionOrError \Exception|\Error|string
     * @param $oneHourMaxTime int 每小时最大次数，0表示无限制
     */
    public static function sendExceptionOrErrorToDeveloper($title, $exceptionOrError, $oneHourMaxTime = 0)
    {
        try {
            if ($exceptionOrError instanceof \Exception || $exceptionOrError instanceof \Error) {
                $msg = [$title, $exceptionOrError->getMessage(), $exceptionOrError->getFile(), $exceptionOrError->getLine()];
            } else {
                $msg = [$title, $exceptionOrError];
            }
        } catch (\Exception $e) {
            $msg = ['获取异常信息有误，到日志中查看'];
        }
        Yii::error($title, ConfigString::CATEGORY_NEED_SOLVED);
        Yii::error($exceptionOrError, ConfigString::CATEGORY_NEED_SOLVED);
        try {
            $canSend = true;
            $cacheResult = 0;
            if ($oneHourMaxTime > 0) {
                $cacheKey = 'bearyChatSendSuccess' . $title;
                $cache = Yii::$app->cache;
                $cacheResult = $cache->get($cacheKey);
                if ($cacheResult) {
                    $cacheResult = intval($cacheResult) + 1;
                } else {
                    $cacheResult = 1;
                }
                $cache->set($cacheKey, $cacheResult, 3600);
                if ($cacheResult > $oneHourMaxTime) {
                    $canSend = false;
                }
            }
            if ($canSend) {
                $msg = array_merge(['project:' . Yii::$app->name], $msg);
                Yii::$app->bearyChat->client()->sendMessage(json_encode(['text' => implode(',', $msg)]));
            } else {
                Yii::error('推送消息给开发者一小时达到限制次数，当前：' . $cacheResult, ConfigString::CATEGORY_NEED_SOLVED);
            }
        } catch (\Exception $e) {
            Yii::error('推送消息给开发者有错误', ConfigString::CATEGORY_NEED_SOLVED);
            Yii::error($e, ConfigString::CATEGORY_NEED_SOLVED);
        }
    }
}