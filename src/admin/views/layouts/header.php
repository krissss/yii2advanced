<?php
/**
 * @var $this \yii\web\View
 */

use common\components\Tools;
use yii\helpers\Html;

/** @var $admin \common\models\Admin */
$admin = Yii::$app->user->identity;
?>

<header class="main-header">

    <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <span class="logo-mini"><?= Tools::getAppName() ?></span>
        <span class="logo-lg">
            <?= Tools::getAppLogoImg() ?>
        </span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <a href="javascript:history.back()" class="return-toggle" role="button">
            <span class="sr-only">返回</span>&nbsp;返回
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="header-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs">&nbsp;<?= $admin->name ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <?= \kriss\iframeLayout\widget\IframeModeSwitchWidget::widget() ?>
                        <?= Html::a('修改密码', ['/account/modify-password'], [
                            'class' => 'dropdown-menu-item'
                        ]) ?>
                        <?= Html::a('退出登录', ['/site/logout'], [
                            'data-method' => 'post',
                            'class' => 'dropdown-menu-item'
                        ]) ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
