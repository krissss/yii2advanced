<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

dmstr\web\AdminLteAsset::register($this);
backend\assets\AppAsset::register($this);
if (!YII_DEBUG && false) {
    backend\assets\IframeLayoutAsset::register($this);
}
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('@common/views/html-head') ?>
    </head>
    <body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render('header.php') ?>

        <?= $this->render('left.php') ?>

        <div class="content-wrapper">
            <ul class="menu-tabs hidden">
                <li>
                    <?= Html::a('<span><i class="fa fa-home"></i></span>', '#') ?>
                </li>
            </ul>
            <div class="content-iframe">
                <?= $this->render('content.php', [
                    'content' => $content,
                ]) ?>
            </div>

        </div>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>