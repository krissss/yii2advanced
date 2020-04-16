<?php

namespace common\components;

use kriss\enum\BaseEnum;

class ParamsName extends BaseEnum
{
    // .env 下定义格式为：PARAM_XXX, XXX 为此处的 key，例如：PARAM_IS_ON
    const IS_ON = 'isOn';

    /**
     * 获取数据格式类型
     * @return array
     */
    public static function getTypes()
    {
        return [
            // 字段 => [类型，默认值]
            // 类型支持见 self::formatValue()
            // 不定义，默认为 string，未取到时为空字符串
            static::IS_ON => ['bool', true],
        ];
    }

    /**
     * 处理数据格式
     * @param $value
     * @param $type
     * @param $defaultValue
     * @return array|bool|int|string
     */
    public static function formatValue($value, $type, $defaultValue)
    {
        if ($type === 'array') {
            $value = $value === null ? $defaultValue : array_filter(array_unique(explode(',', $value)));
        } elseif ($type === 'bool') {
            $value = $value === null ? $defaultValue : boolval($value);
        } elseif ($type === 'string') {
            $value = $value === null ? $defaultValue : strval($value);
        } elseif ($type === 'int') {
            $value = $value === null ? $defaultValue : intval($value);
        }
        return $value;
    }
}
