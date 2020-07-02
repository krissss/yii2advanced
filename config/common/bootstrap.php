<?php

$projectRoot = dirname(dirname(__DIR__));
Yii::setAlias('@project', $projectRoot . '/');
Yii::setAlias('@runtimePath', $projectRoot . '/runtime');
Yii::setAlias('@publicRoot', $projectRoot . '/public');
Yii::setAlias('@common', $projectRoot . '/src/common');
Yii::setAlias('@console', $projectRoot . '/src/console');
Yii::setAlias('@admin', $projectRoot . '/src/admin');
Yii::setAlias('@api', $projectRoot . '/src/api');
