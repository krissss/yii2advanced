<?php

namespace common\models\settings;

use Yii;
use yii\helpers\Url;

/**
 * @method static string name($default = null)
 * @method static string logo($default = null)
 * @method static string favicon($default = null)
 */
class SettingApp extends BaseModel
{
    public $name;
    public $logo;
    public $favicon;

    public function rules()
    {
        return [
            [['name', 'logo', 'favicon'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '网站名称',
            'logo' => '网站logo',
            'favicon' => '网站favicon',
        ];
    }

    public function attributeHints()
    {
        return [
            'logo' => '建议大小：高度60px，宽度随意，png文件',
            'favicon' => '建议大小：16*16，ico文件',
        ];
    }

    public function attributeDefaultValue()
    {
        return [
            'name' => Yii::$app->name,
            'logo' => Url::to('@public/common/images/logo.png'),
            'favicon' => Url::to('@public/common/images/favicon.ico'),
        ];
    }
}
