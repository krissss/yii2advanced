<?php
/**
 * @var $this yii\web\view
 * @var $model admin\models\UserSearch
 */

use kriss\widgets\DateTimeRangePicker;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

echo Html::beginTag('div', ['class' => 'card']);
echo Html::beginTag('div', ['class' => 'card-body']);
$form = ActiveForm::begin([
    'action' => ['index'],
    'layout' => ActiveForm::LAYOUT_DEFAULT,
]);
echo Html::beginTag('div', ['class' => 'form-row']);
echo $form->field($model, 'cellphone', ['options' => ['class' => ['widget' => 'col-md-2 form-group']]]);
echo $form->field($model, 'name', ['options' => ['class' => ['widget' => 'col-md-2 form-group']]]);
echo $form->field($model, 'created_at', ['options' => ['class' => ['widget' => 'col-md-3 form-group']]])->widget(DateTimeRangePicker::class);
echo Html::endTag('div');

echo Html::resetInput('重置', ['class' => 'btn btn-default mr-2']);
echo Html::submitInput('查询', ['class' => 'btn btn-primary']);

$form->end();

echo Html::endTag('div');
echo Html::endTag('div');
