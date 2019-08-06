<?php
/**
 * @var $this yii\web\view
 * @var $model admin\models\UserSearch
 */

use kriss\widgets\DateTimeRangePicker;
use kriss\widgets\SimpleSearchForm;

$form = SimpleSearchForm::begin(['action' => ['index']]);

echo $form->field($model, 'cellphone');
echo $form->field($model, 'name');
echo $form->field($model, 'created_at')->widget(DateTimeRangePicker::class);

$form->end();
