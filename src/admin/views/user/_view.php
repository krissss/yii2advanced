<?php
/**
 * @var yii\web\view $this
 * @var common\models\User $model
 */

use kriss\widgets\SimpleAjaxView;
use yii\widgets\DetailView;

$this->title = '用户详情';

SimpleAjaxView::begin(['header' => $this->title]);

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'cellphone',
        'name',
        [
            'attribute' => 'status',
            'value' => $model->getStatusName(),
        ],
        [
            'attribute' => 'created_at',
            'value' => date('Y-m-d H:i:s', $model->created_at),
        ],
        [
            'attribute' => 'updated_at',
            'value' => date('Y-m-d H:i:s', $model->created_at),
        ],
    ]
]);

SimpleAjaxView::end();
