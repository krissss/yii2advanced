<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\settings\SettingApp
 */

use kriss\widgets\SimpleActiveForm;

$this->title = '系统设置';

$form = SimpleActiveForm::begin([
    'title' => $this->title,
]);

echo $form->field($model, 'name');
echo $form->field($model, 'logo');
echo $form->field($model, 'favicon');

$form->end();
