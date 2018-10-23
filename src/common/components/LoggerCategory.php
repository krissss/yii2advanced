<?php

namespace common\components;

use kriss\enum\BaseEnum;

class LoggerCategory extends BaseEnum
{
    const NEED_SOLVE = 'needSolve';
    const QUEUE_JOB = 'queueJob';
}
