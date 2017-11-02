<?php
/** @var $this \yii\web\View */

/** @var \common\models\Admin $user */
$user = Yii::$app->user->identity;

echo '<h1 class="text-center">欢迎：'.$user->name.'</h1>';