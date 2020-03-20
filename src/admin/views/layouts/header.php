<?php
/**
 * @var $this \yii\web\View
 */

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

/** @var $admin \common\models\Admin */
$admin = Yii::$app->user->identity;

$leftMenus = [
    ['label' => 'Home', 'url' => '#'],
    ['label' => 'Contact', 'url' => '#'],
    ['label' => 'Help', 'url' => '#', 'items' => [
        ['label' => 'FAQ', 'url' => '#'],
        ['label' => 'Support', 'url' => '#'],
        '-',
        ['label' => 'Contact', 'url' => '#'],
    ]],
];
$rightMenus = [];
?>
<?php
$navBar = NavBar::begin([
    'brandLabel' => false,
    'options' => ['class' => 'main-header navbar-expand navbar-white navbar-light'],
    'renderInnerContainer' => false,
    'collapseOptions' => ['tag' => null],
]);
?>
    <!-- Left navbar links -->
<?= Nav::widget([
    'items' => array_merge([
        ['label' => '<i class="fas fa-bars"></i>', 'encode' => false, 'linkOptions' => ['data-widget' => 'pushmenu'], 'url' => '#'],
    ], $leftMenus),
    'options' => ['class' => 'navbar-nav'],
]) ?>
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Right navbar links -->
<?= Nav::widget([
    'items' => array_merge($rightMenus, [
        ['label' => $admin->name, 'url' => '#', 'items' => [
            ['label' => '修改密码', 'url' => '#'],
            '-',
            ['label' => '退出登录', 'url' => '#'],
        ]],
    ]),
    'options' => ['class' => 'navbar-nav ml-auto'],
]) ?>
<?php
$navBar->end();
