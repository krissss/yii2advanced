<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */

use admin\assets\AppAsset;
use dmstr\helpers\AdminLteHelper;
use dmstr\web\AdminLteAsset;
use kriss\iframeLayout\widget\IframeModeAssetWidget;
use yii\helpers\Html;

AdminLteAsset::register($this);
AppAsset::register($this);
IframeModeAssetWidget::widget();
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('@common/views/html-head') ?>
    </head>
    <body class="<?= AdminLteHelper::skinClass() ?>">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render('header.php') ?>

        <?= $this->render('left.php') ?>

        <?= Html::tag('div', '加载中', ['class' => 'loading', 'style' => 'display:none']) ?>

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
