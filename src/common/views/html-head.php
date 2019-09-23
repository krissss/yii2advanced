<?php
/**
 * @var $this \yii\web\View
 */

use common\models\settings\SettingApp;
use yii\helpers\Html;

?>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <link rel="icon" href="<?= Yii::getAlias(SettingApp::getValue('favicon')) ?>">
<?= $this->render('analysis') ?>
<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
