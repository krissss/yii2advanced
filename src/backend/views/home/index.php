<?php
/** @var $this \yii\web\View */

$this->title = '首页';

/** @var \common\models\Admin $user */
$user = Yii::$app->user->identity;

echo '<h1 class="text-center">欢迎：' . $user->name . '</h1>';