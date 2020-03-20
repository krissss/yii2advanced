<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider
 * @var $searchModel
 */

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use kriss\widgets\ActionColumn;
use kriss\widgets\DatetimeColumn;
use kriss\widgets\LinkPagerWithSubmit;
use kriss\widgets\SimpleDynaGrid;
use kriss\widgets\UsedUnusedStatusColumn;
use yii\helpers\Html;

$this->title = '用户列表';
$this->params['breadcrumbs'] = [
    $this->title,
];

echo $this->render('_search', [
    'model' => $searchModel,
]);

$columns = [
    [
        'attribute' => 'id',
    ],
    [
        'attribute' => 'cellphone',
    ],
    [
        'attribute' => 'name',
    ],
    [
        'class' => UsedUnusedStatusColumn::class,
        'attribute' => 'status',
    ],
    [
        'class' => DatetimeColumn::class,
        'attribute' => 'created_at',
    ],
    [
        'class' => DatetimeColumn::class,
        'attribute' => 'updated_at',
    ],
    [
        'class' => ActionColumn::class,
        'groupButtons' => [
            ['action' => 'view', 'label' => '详情', 'cssClass' => 'show_ajax_modal'],
            ['action' => 'update', 'label' => '修改', 'type' => 'primary', 'cssClass' => 'show_ajax_modal'],
        ],
    ],
];

$layout = <<<HTML
<div class="card">
<div class="card-header">
{summary}
<div class="">
{toolbar}
</div>
</div>
<div class="card-body">
{items}
{pager}
</div>
</div>
HTML;
echo GridView::widget([
    'columns' => $columns,
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'layout' => $layout,
    'pager' => [
        'options' => ['class' => 'pagination justify-content-center mt-3 mb-0']
    ],
    'toolbar' => [
        [
            'content' => Html::button('新增', ['class' => 'btn btn-primary'])
        ]
    ],
]);

/*echo SimpleDynaGrid::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns,
    'extraToolbar' => [
        [
            'content' => Html::a('新增', ['create'], ['class' => 'btn btn-primary show_ajax_modal'])
        ]
    ],
]);*/
