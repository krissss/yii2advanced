<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0);">
            <?= Html::img('@web/images/logo.png', [
                'alt' => Yii::$app->name,
                'style' => 'max-width: 80%;'
            ]) ?>
        </a>
    </div>
    <div class="login-box-body">
        <h3><?= $name ?></h3>
        <p><?= $message ?></p>
    </div>
</div>