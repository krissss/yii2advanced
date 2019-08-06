<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider
 */

use common\models\Admin;
use kriss\widgets\ActionColumn;
use kriss\widgets\SimpleDynaGrid;
use kriss\widgets\UsedUnusedStatusColumn;
use yii\helpers\Html;

$this->title = '管理员管理列表';
$this->params['breadcrumbs'] = [
    $this->title,
];

$columns = [
    [
        'attribute' => 'id',
    ],
    [
        'attribute' => 'username',
    ],
    [
        'attribute' => 'name',
    ],
    [
        'class' => UsedUnusedStatusColumn::class,
        'canOperate' => function (Admin $model) {
            return $model->id != Admin::SUPER_ADMIN_ID;
        }
    ],
    [
        'class' => ActionColumn::class,
        'groupButtons' => [
            [
                'action' => 'update', 'label' => '更新', 'cssClass' => 'show_ajax_modal',
                'visible' => function (Admin $model) {
                    return $model->id != Admin::SUPER_ADMIN_ID;
                }
            ],
            [
                'action' => 'reset-password', 'label' => '重置密码', 'type' => 'danger', 'cssClass' => 'show_ajax_modal',
                'visible' => function (Admin $model) {
                    return $model->id != Admin::SUPER_ADMIN_ID && $model->id != Yii::$app->user->id;
                }
            ],
            [
                'action' => 'update-role', 'label' => '授权', 'type' => 'warning', 'cssClass' => 'show_ajax_modal',
                'visible' => function (Admin $model) {
                    return $model->id != Admin::SUPER_ADMIN_ID && $model->id != Yii::$app->user->id;
                }
            ],
        ],
    ],
];

echo SimpleDynaGrid::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns,
    'extraToolbar' => [
        [
            'content' => Html::a('新增', ['create'], ['class' => 'btn btn-primary show_ajax_modal'])
        ],
    ],
]);
