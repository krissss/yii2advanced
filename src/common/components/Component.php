<?php

namespace common\components;

use kriss\storage\Storage;
use Yii;
use yii\base\InvalidConfigException;

/**
 * @method static Storage storage()
 */
class Component
{
    public static function __callStatic($name, $arguments)
    {
        $component = Yii::$app->get($name);
        if (!$component) {
            throw new InvalidConfigException("unknown {$name} component");
        }
        return $component;
    }

    public static function flySystem()
    {
        return static::storage()->getFileSystem();
    }
}
