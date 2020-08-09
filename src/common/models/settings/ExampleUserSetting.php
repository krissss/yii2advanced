<?php

namespace common\models\settings;

/**
 * 针对个人的配置例子
 * @method string key1($default = null)
 * @method string keyName2($default = null)
 */
class ExampleUserSetting extends BaseUserModel
{
    public $key1;
    public $key_name2;

    public function rules()
    {
        return [
            [['key1', 'key_name2'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'key1' => 'Key 1',
            'key_name2' => 'Key 2',
        ];
    }

    protected function attributeDefaultValue()
    {
        return [
            'key1' => 'default 1',
            'key_name2' => 'default 2'
        ];
    }
}
