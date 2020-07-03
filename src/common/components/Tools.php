<?php

namespace common\components;

use common\models\settings\SettingApp;
use kriss\tools\Fun;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
     * 在后台执行 console 下 controller 中的方法
     * @param $yiiCmd
     * @param null $yiiExecFile
     * @param null $phpExecFile
     */
    public static function runYiiConsoleInBackground($yiiCmd, $yiiExecFile = null, $phpExecFile = null)
    {
        if ($yiiExecFile === null) {
            $yiiExecFile = dirname(dirname(Yii::getAlias('@console'))) . DIRECTORY_SEPARATOR . 'yii';
        }
        parent::runYiiConsoleInBackground($yiiCmd, $yiiExecFile, $phpExecFile);
    }

    /**
     * @return string
     */
    public static function getAppName()
    {
        return SettingApp::name(Yii::$app->name);
    }

    /**
     * @param array $options
     * @return string
     */
    public static function getAppLogoImg($options = [])
    {
        $logo = SettingApp::logo();
        if (!$logo || $logo === '-') {
            return static::getAppName();
        }

        $options = ArrayHelper::merge([
            'alt' => static::getAppName(),
        ], $options);
        return Html::img($logo, $options);
    }

    /**
     * 获取用户ip
     * @return mixed|null|string
     */
    public static function getUserIp()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        }
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }
}
