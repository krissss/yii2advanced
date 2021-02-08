<?php
/**
 * @var \yii\web\View $this
 */

use common\models\settings\SettingApp;
use yii\helpers\Html;

$favicon = SettingApp::favicon()
?>
<meta charset="<?= Yii::$app->charset ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<?php if ($favicon && $favicon !== '-'): ?>
    <link rel="icon" href="<?= $favicon ?>">
<?php endif; ?>
<?php // echo $this->render('analysis');?>
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
