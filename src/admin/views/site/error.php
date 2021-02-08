<?php
/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

use common\components\Tools;

$this->title = $name;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0);">
            <?= Tools::getAppLogoImg([
                'style' => 'max-width: 80%;'
            ]) ?>
        </a>
    </div>
    <div class="login-box-body">
        <h3><?= $name ?></h3>
        <p><?= $message ?></p>
    </div>
</div>
