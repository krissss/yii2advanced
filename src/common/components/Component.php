<?php

namespace common\components;

use Yii;
use yii\base\InvalidConfigException;

/**
 * @method static \kriss\storage\Storage storage()
 * @method static \yii2mod\settings\components\Settings settings()
 * @method static \jianyan\easywechat\Wechat wechat()
 * @method static EncoreAssetLoader encoreAssetLoader()
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
