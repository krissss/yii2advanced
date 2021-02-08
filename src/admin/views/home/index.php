<?php
/**
 * @var \yii\web\View $this
 */

$this->title = '首页';

/** @var \common\models\Admin $user */
$user = Yii::$app->user->identity;

echo '<h1 class="text-center">欢迎：' . $user->name . '</h1>';
