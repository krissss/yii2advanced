<?php
/** @var $this yii\web\View */
/** @var $dataProvider */

use common\models\Admin;
use kriss\widgets\ActionColumn;
use kriss\widgets\SimpleDynaGrid;
use kriss\widgets\ToggleColumn;
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
        'class' => ToggleColumn::class,
        'attribute' => 'status',
        'action' => 'change-status',
        'items' => [
            Admin::STATUS_NORMAL => '正常',
            Admin::STATUS_DISABLE => '禁用',
        ],
        'onValue' => Admin::STATUS_NORMAL,
        'offValue' => Admin::STATUS_DISABLE,
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

$simpleDynaGrid = new SimpleDynaGrid([
    'dynaGridId' => 'dynagrid-admin-index',
    'columns' => $columns,
    'dataProvider' => $dataProvider,
    'extraToolbar' => [
        [
            'content' => Html::a('新增', ['create'], ['class' => 'btn btn-primary show_ajax_modal'])
        ]
    ]
]);
$simpleDynaGrid->renderDynaGrid();
