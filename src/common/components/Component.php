<?php

namespace common\components;

use kriss\storage\Storage;
use Yii;
use yii\base\InvalidConfigException;
use yii2mod\settings\components\Settings;

/**
 * @method static Storage storage()
 * @method static Settings settings()
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

    public static function fileSystem()
    {
        return static::storage()->getFileSystem();
    }
}
