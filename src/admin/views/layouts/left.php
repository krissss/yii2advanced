<?php
/**
 * @var $this \yii\web\View
 */

use common\models\Admin;

/** @var $admin Admin */
$admin = Yii::$app->user->identity;

$menuTitle = '总管理后台';
$baseUrl = '';
$menu = [
    ['label' => '首页', 'icon' => 'circle-o', 'url' => [$baseUrl . '/home']],
    ['label' => '用户管理', 'icon' => 'circle-o', 'url' => [$baseUrl . '/user']],
    ['label' => '管理员管理', 'icon' => 'circle-o', 'url' => [$baseUrl . '/admin']],
    [
        'label' => '权限管理', 'icon' => 'list', 'url' => '#',
        'items' => [
            ['label' => '权限查看', 'icon' => 'circle-o', 'url' => [$baseUrl . '/auth/permission']],
            ['label' => '角色管理', 'icon' => 'circle-o', 'url' => [$baseUrl . '/auth/role']],
        ]
    ],
    ['label' => '系统设置', 'icon' => 'circle-o', 'url' => [$baseUrl . '/setting/app']],
];
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
