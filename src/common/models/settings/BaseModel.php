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
        return Component::settings()->get(
            static::getSectionName(),
            $key,
            isset(static::attributeDefaultValue()[$key]) ? static::attributeDefaultValue()[$key] : $defaultValue
        );
    }

    abstract protected static function attributeDefaultValue();
}
