<?php

namespace common\components;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * @method static string XXX()
 */
class Params
{
    public static function __callStatic($name, $arguments)
    {
        if (isset(Yii::$app->params[$name])) {
            $val = Yii::$app->params[$name];
            return Yii::getAlias($val);
        }
        throw new NotFoundHttpException('未定义的param：' . $name);
    }
}
