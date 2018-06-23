<?php

namespace common\models\base;

use Yii;

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
}