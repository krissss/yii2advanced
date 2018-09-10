<?php

namespace common\models\enum;

use kriss\enum\BaseEnum;

class AdminStatus extends BaseEnum
{
    const NORMAL = 0;
    const DISABLE = 10;

    public static function getViewItems()
    {
        return [
            static::NORMAL => '正常',
            static::DISABLE => '不可用',
        ];
    }
}
