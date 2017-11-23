<?php
/** @var $this yii\web\View */
/** @var $dataProvider common\components\ActiveDataProvider */

use backend\widgets\SimpleDynaGrid;
use yii\helpers\Html;
use common\models\Admin;

$this->title = '管理员管理列表';
$this->params['breadcrumbs'] = [
    '管理员管理',
    $this->title,
];

$columns = [
    [
        'attribute' => 'username',
    ],
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'status',
        'value' => function (Admin $model) {
            return $model->getStatusName();
        }
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'width' => '300px',
        'template' => '{update} {update-role} {reset-password} {change-status}',
        'buttons' => [
            'update' => function ($url, Admin $model) {
                if ($model->id == Admin::SUPER_ADMIN_ID) {
                    return '';
                }
                $options = [
                    'class' => 'btn btn-default show_ajax_modal',
                ];
                return Html::a('更新', $url, $options);
            },
            'update-role' => function ($url, $model) {
                if ($model->id != Admin::SUPER_ADMIN_ID && $model->id != Yii::$app->user->id) {
                    $options = [
                        'class' => 'btn btn-warning show_ajax_modal',
                    ];
                    return Html::a('授权', $url, $options);
                }
                return '';
            },
            'change-status' => function ($url, Admin $model) {
                if ($model->id == Admin::SUPER_ADMIN_ID) {
                    return '';
                }
                $options = [
                    'class' => 'btn btn-danger',
                    'data-method' => 'post'
                ];
                if ($model->status == Admin::STATUS_NORMAL) {
                    return Html::a('禁用', ['change-status', 'id' => $model->id, 'status' => Admin::STATUS_DISABLE], $options);
                } elseif ($model->status == Admin::STATUS_DISABLE) {
                    return Html::a('恢复', ['change-status', 'id' => $model->id, 'status' => Admin::STATUS_NORMAL], $options);
                }
                return '';
            },
            'reset-password' => function ($url, Admin $model) {
                if ($model->id == Admin::SUPER_ADMIN_ID) {
                    return '';
                }
                $options = [
                    'class' => 'btn btn-danger show_ajax_modal',
                ];
                return Html::a('重置密码', $url, $options);
            },
        ],
    ],
];

$simpleDynaGrid = new SimpleDynaGrid([
    'dynaGridId' => 'dynagrid-admin-index',
    'columns' => $columns,
    'dataProvider' => $dataProvider,
    'extraToolbar' => [
        [
            'content' => Html::a('新增', ['create'], ['class' => 'btn btn-default show_ajax_modal'])
        ]
    ]
]);
$simpleDynaGrid->renderDynaGrid();
