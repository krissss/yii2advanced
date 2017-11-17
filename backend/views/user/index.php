<?php
/** @var $this yii\web\View */
/** @var $dataProvider common\components\ActiveDataProvider */
/** @var $searchModel backend\models\UserSearch */

use backend\widgets\SimpleDynaGrid;
use common\models\User;
use yii\helpers\Html;

$this->title = '用户管理列表';
$this->params['breadcrumbs'] = [
    '用户管理',
    $this->title,
];

echo $this->render('_search', [
    'model' => $searchModel,
]);

$columns = [
    [
        'attribute' => 'cellphone',
    ],
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'status',
        'value' => function (User $model) {
            return $model->getStatusName();
        }
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'width' => '150px',
        'template' => '{change-status}',
        'buttons' => [
            'change-status' => function ($url, User $model) {
                $options = [
                    'class' => 'btn btn-danger',
                    'data-method' => 'post'
                ];
                if ($model->status == User::STATUS_NORMAL) {
                    return Html::a('禁用', ['change-status', 'id' => $model->id, 'status' => User::STATUS_DISABLE], $options);
                } elseif ($model->status == User::STATUS_DISABLE) {
                    return Html::a('恢复', ['change-status', 'id' => $model->id, 'status' => User::STATUS_NORMAL], $options);
                }
                return '';
            },
        ],
    ],
];

$simpleDynaGrid = new SimpleDynaGrid([
    'dynaGridId' => 'dynagrid-user-index',
    'columns' => $columns,
    'dataProvider' => $dataProvider,
]);
$simpleDynaGrid->renderDynaGrid();
