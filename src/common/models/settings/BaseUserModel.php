<?php

namespace common\models\settings;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Inflector;

/**
 * 用于针对某个用户的配置
 * use:
 * ExampleSetting::getInstance()->key1();
 * ExampleSetting::getInstance()->withUserId($userId)->keyName2();
 */
abstract class BaseUserModel extends BaseModel
{
    public $userId;

    public function init()
    {
        if (!$this->userId) {
            $this->userId = Yii::$app->user->id;
        }
    }

    public function withUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function getSectionName()
    {
        if (!$this->userId) {
            throw new InvalidConfigException('no userId');
        }
        return $this->userId . '_' . $this->formName();
    }

    public function __call($name, $params)
    {
        return $this->getValue(Inflector::underscore($name), $arguments[0] ?? null);
    }
}
