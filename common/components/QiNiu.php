<?php

namespace common\components;

use kriss\qiniu\QiNiuComponent;

class QiNiu extends QiNiuComponent
{
    /**
     * 存储文件路径
     * 例如： xxx/
     * @var string
     */
    public $savePath = '';
}