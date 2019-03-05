<?php

namespace common\models\settings;

use common\components\Component;
use yii\base\Model;

abstract class BaseModel extends Model
{
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
        if (!$value && isset(static::attributeDefaultValue()[$key])) {
            return static::attributeDefaultValue()[$key];
        }
        return $value;
    }

    abstract protected static function attributeDefaultValue();
}
