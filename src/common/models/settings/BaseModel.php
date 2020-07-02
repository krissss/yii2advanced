<?php

namespace common\models\settings;

use common\components\Component;
use yii\base\Model;

abstract class BaseModel extends Model
{
    const NULL_VALUE = [null, ''];

    protected static function getSectionName()
    {
        $self = new static();
        return $self->formName();
    }

    public static function getValue($key, $defaultValue = null)
    {
        $value = Component::settings()->get(
            static::getSectionName(),
            $key,
            $defaultValue
        );
        if (in_array($value, static::NULL_VALUE) && isset(static::attributeDefaultValue()[$key])) {
            return static::attributeDefaultValue()[$key];
        }
        return $value;
    }

    abstract protected static function attributeDefaultValue();

    public static function __callStatic($name, $arguments)
    {
        return static::getValue($name, $arguments[0] ?? null);
    }
}
