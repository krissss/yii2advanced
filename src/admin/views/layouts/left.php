<?php
/**
 * @var \yii\web\View $this
 */

use common\models\Admin;
use kriss\modules\auth\tools\AuthValidate;

/** @var Admin $admin */
$admin = Yii::$app->user->identity;
$authUsed = false;

$menuTitle = '总管理后台';
$baseUrl = '';
$menu = [
    ['label' => '首页', 'icon' => 'circle-o', 'url' => [$baseUrl . '/home']],
    ['label' => '用户管理', 'icon' => 'circle-o', 'url' => [$baseUrl . '/user']],
    ['label' => '管理员管理', 'icon' => 'circle-o', 'url' => [$baseUrl . '/admin']],
    ['label' => '系统设置', 'icon' => 'circle-o', 'url' => [$baseUrl . '/setting/app']],
];
// auth
if ($authUsed) {
    $menu[] = [
        'label' => '权限管理', 'icon' => 'list', 'url' => '#',
        'items' => [
            ['label' => '权限查看', 'icon' => 'circle-o', 'url' => [$baseUrl . '/auth/permission']],
            ['label' => '角色管理', 'icon' => 'circle-o', 'url' => [$baseUrl . '/auth/role']],
        ]
    ];
    $menu = AuthValidate::filterMenusRecursive($menu);
}
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel text-center">
            <h4><?= $menuTitle ?></h4>
        </div>

        <?= dmstr\widgets\Menu::widget([
            'options' => [
                'class' => 'sidebar-menu',
                'data-widget' => 'tree'
            ],
            'items' => array_merge([
                ['label' => '菜单', 'options' => ['class' => 'header']],
            ], $menu),
        ]) ?>

    </section>

</aside>
