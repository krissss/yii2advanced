<?php

namespace common\models\base;

use Yii;
use yii\base\InvalidArgumentException;

class ActiveRecord extends \kriss\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $time = time();
        $userId = Yii::$app->has('user') ? Yii::$app->user->getId() : null;
        if ($this->isNewRecord) {
            if ($this->hasAttribute('created_at')) {
                $this->setAttribute('created_at', $time);
            }
            if ($userId !== null && $this->hasAttribute('created_by')) {
                $this->setAttribute('created_by', $userId);
            }
        }

        if ($this->hasAttribute('updated_at')) {
            $this->setAttribute('updated_at', $time);
        }
        if ($userId !== null && $this->hasAttribute('updated_by')) {
            $this->setAttribute('updated_by', $userId);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    /*public function optimisticLock()
    {
        if ($this->hasAttribute('version')) {
            return 'version';
        }
        return parent::optimisticLock();
    }*/

    /**
     * @inheritdoc
     */
    /*public function fields()
    {
        $fields = parent::fields();
        unset($fields['version']);
        return $fields;
    }*/

    /**
     * 批量更新，调整已应对不经意导致的批量更新错误
     * @param array $attributes
     * @param string $condition
     * @param array $params
     * @return int
     */
    public static function updateAll($attributes, $condition = '', $params = [])
    {
        if ($condition === '') {
            throw new InvalidArgumentException('传递的 condition 为空，请确认，如果确定需要更新全部数据，condition 传 "force" 字符串');
        }
        if ($condition === 'force') {
            $condition = '';
        }
        return parent::updateAll($attributes, $condition, $params);
    }
}
