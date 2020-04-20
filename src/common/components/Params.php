<?php

namespace common\components;

use Yii;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;

/**
 * @method static bool isOn()
 */
class Params
{
    public static function __callStatic($name, $arguments)
    {
        if (isset(Yii::$app->params[$name])) {
            $val = Yii::$app->params[$name];
            if ($val && is_string($val) && StringHelper::startsWith($val, '@')) {
                $val = Yii::getAlias($val);
            }
            return $val;
        }
        throw new NotFoundHttpException('未定义的param：' . $name);
    }

    /**
     * @return array
     */
    public static function loadFromEnv()
    {
        // 如果参数多，建议使用缓存，注意不能使用 Yii::$app->cache 因为在param加载时还未初始化完成
        $result = [];
        $names = ParamsName::getValues();
        $types = ParamsName::getTypes();
        foreach (ParamsName::getKeys() as $index => $key) {
            $value = get_env('PARAM_' . $key, null);

            $name = $names[$index];
            if (isset($types[$name])) {
                list($type, $defaultValue) = $types[$name];
                $value = ParamsName::formatValue($value, $type, $defaultValue);
            } else {
                // 默认为字符串类型
                $value = $value === null ? '' : strval($value);
            }
            $result[$name] = $value;
        }

        return $result;
    }
}
