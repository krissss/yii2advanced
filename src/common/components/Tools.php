<?php

namespace common\components;

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
}
