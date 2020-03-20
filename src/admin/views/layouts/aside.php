<?php
/**
 * @var $this \yii\web\View
 */

use common\models\Admin;
use kriss\adminlte\widgets\Menu;
use kriss\modules\auth\tools\AuthValidate;

/** @var $admin Admin */
$admin = Yii::$app->user->identity;
$authUsed = true;

$menuTitle = '总管理后台';
$baseUrl = '';
$menu = [
    ['label' => '首页', 'url' => [$baseUrl . '/home/index']],
    ['label' => '用户管理', 'url' => [$baseUrl . '/user/index']],
    ['label' => '管理员管理', 'url' => [$baseUrl . '/admin']],
    ['label' => '系统设置', 'url' => [$baseUrl . '/setting/app']],
];
// auth
if ($authUsed) {
    $menu[] = [
        'label' => '权限管理', 'url' => '#',
        'items' => [
            ['label' => '权限查看', 'url' => [$baseUrl . '/auth/permission']],
            ['label' => '角色管理', 'url' => [$baseUrl . '/auth/role']],
        ]
    ];
    $menu = AuthValidate::filterMenusRecursive($menu);
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">-->
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!--<div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>-->
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?= Menu::widget([
                'items' => $menu,
            ]) ?>
        </nav>
</aside>

