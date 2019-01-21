<?php

use common\components\ComponentName;

return [
    ComponentName::STORAGE => [
        'class' => \kriss\storage\Storage::class,
        'adapter' => function () {
            return new \League\Flysystem\Adapter\Local(Yii::getAlias('@runtimePath/storage'));
        },
    ],
    ComponentName::SETTINGS => [
        'class' => 'yii2mod\settings\components\Settings',
    ],
];
