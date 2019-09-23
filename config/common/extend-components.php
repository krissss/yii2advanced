<?php

use common\components\ComponentName;
use League\Flysystem\Adapter\Local;

return [
    ComponentName::STORAGE => [
        'class' => 'kriss\storage\Storage',
        'adapter' => function () {
            return new Local(Yii::getAlias('@runtimePath/storage'));
        },
    ],
    ComponentName::SETTINGS => [
        'class' => 'yii2mod\settings\components\Settings',
    ],
];
