<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */

\kriss\iframeLayout\widget\IframeModeAssetWidget::widget();
\admin\assets\AppAsset::register($this);

use yii\helpers\Html; ?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('@common/views/html-head') ?>
    </head>
    <body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
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
