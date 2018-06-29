<?php

namespace common\models\base;

use common\components\QiNiu;
use Yii;

class ConfigString
{
    // component
    const COMPONENT_QI_NIU = 'qi_niu';

    // log category
    const CATEGORY_NEED_SOLVED = 'need-solved';
    const CATEGORY_QUEUE_JOB = 'queue-job';

    /**
     * @return null|object|QiNiu
     */
    public static function getQiNiu()
    {
        return Yii::$app->get(static::COMPONENT_QI_NIU);
    }

    /**
     * @return \League\Flysystem\Filesystem
     */
    public static function getDisk()
    {
        return static::getQiNiu()->getDisk();
    }
}
