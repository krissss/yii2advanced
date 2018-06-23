<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="login-container active">
    <a href="javascript:void(0)">
        <?= Html::img('@web/images/logo.png', ['height' => 50]) ?>
    </a>
    <h3><?= $name ?></h3>
    <p><?= $message ?></p>
</div>