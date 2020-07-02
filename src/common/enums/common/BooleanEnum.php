<?php

namespace common\enums\common;

use kriss\enum\BoolEnum;

class BooleanEnum extends BoolEnum
{
    public static function getViewItems()
    {
        return [
            self::YES => '是',
            self::NO => '否',
        ];
    }
}
