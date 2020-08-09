<?php

namespace common\models\settings;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Inflector;

/**
 * 用于针对某个用户的配置
 * use:
 * ExampleSetting::getInstance($userId)->key1();
 * ExampleSetting::getInstance()->keyName2();
 */
abstract class BaseUserModel extends BaseModel
{
    protected $userId;

    public function __construct($userId = 'current')
    {
        if ($userId === 'current') {
            $userId = Yii::$app->user->id;
        }
        $this->userId = $userId;
        parent::__construct();
    }

    public static function getInstance($userId = 'current')
    {
        return new static($userId);
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
