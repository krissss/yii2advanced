<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */

use kriss\adminlte\assets\AdminLteAsset;
use yii\helpers\Html;

AdminLteAsset::register($this);
//admin\assets\AppAsset::register($this);
//\kriss\iframeLayout\widget\IframeModeAssetWidget::widget();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= $this->render('@common/views/html-head') ?>
</head>
<body class="sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $this->render('header.php') ?>
    <?= $this->render('aside.php') ?>
    <div class="content-wrapper">
        <?= Html::tag('div', '加载中', ['class' => 'loading', 'style' => 'display:none']) ?>
        <?= $this->render('content.php', [
            'content' => $content,
        ]) ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
