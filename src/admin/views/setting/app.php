<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\settings\SettingApp
 */

use common\models\settings\SettingApp;
use kriss\widgets\SimpleActiveForm;

$this->title = '系统设置';

$form = SimpleActiveForm::begin([
    'title' => $this->title,
]);

echo $form->field($model, 'name')->textInput(['value' => SettingApp::name()]);
echo $form->field($model, 'logo')->textInput(['value' => SettingApp::logo()]);
echo $form->field($model, 'favicon')->textInput(['value' => SettingApp::favicon()]);

$form->end();
