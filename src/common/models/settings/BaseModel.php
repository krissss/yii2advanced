<?php

namespace common\models\settings;

use common\components\Component;
use yii\base\Model;
use yii\helpers\Inflector;

/**
 * 用于全局的配置参数
 * use:
 * SettingApp::name();
 * SettingApp::appName();
 * SettingApp::getInstance()->getValue('name');
 */
abstract class BaseModel extends Model
{
    const NULL_VALUE = [null, ''];

    final public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function getSectionName()
    {
        return $this->formName();
    }

    public static function getInstance()
    {
        return new static();
    }

    public function getValue($key, $defaultValue = null)
    {
        $value = Component::settings()->get(
            $this->getSectionName(),
            $key,
            $defaultValue
        );
        if (in_array($value, static::NULL_VALUE) && isset($this->attributeDefaultValue()[$key])) {
            return $this->attributeDefaultValue()[$key];
        }
        return $value;
    }

    abstract protected function attributeDefaultValue();

    public static function __callStatic($name, $arguments)
    {
        return static::getInstance()->getValue(Inflector::underscore($name), $arguments[0] ?? null);
    }
}
