<?php

namespace common\components;

use Yii;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;

/**
 * @method static string filePathSmsConf()
 */
class Params
{
    public static function __callStatic($name, $arguments)
    {
        if (isset(Yii::$app->params[$name])) {
            $val = Yii::$app->params[$name];
            if (StringHelper::startsWith($name, 'filePath')) {
                return Yii::getAlias($val);
            }
            return $val;
        }
        throw new NotFoundHttpException('未定义的param：' . $name);
    }
}
