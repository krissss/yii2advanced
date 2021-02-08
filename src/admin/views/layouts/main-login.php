<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */

use dmstr\web\AdminLteAsset;
use kriss\widgets\Alert;

AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('@common/views/html-head') ?>
    </head>
    <body class="login-page">
    <?php $this->beginBody() ?>
    <?= Alert::widget() ?>

    <?= $content ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
