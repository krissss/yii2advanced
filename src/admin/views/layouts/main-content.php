<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */

use admin\assets\AppAsset;
use dmstr\helpers\AdminLteHelper;
use kriss\iframeLayout\widget\IframeModeAssetWidget;
use yii\helpers\Html;

IframeModeAssetWidget::widget();
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('@common/views/html-head') ?>
    </head>
    <body class="<?= AdminLteHelper::skinClass() ?>">
    <?php $this->beginBody() ?>

    <?= Html::tag('div', '加载中', ['class' => 'loading', 'style' => 'display:none']) ?>
    <div class="iframe-content-wrapper content-wrapper">

        <?= $this->render('content.php', [
            'content' => $content,
        ]) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
