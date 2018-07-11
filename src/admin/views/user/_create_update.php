<?php
/** @var $this yii\web\view */
/** @var $model common\models\User */

use kriss\widgets\SimpleAjaxForm;

$this->title = $model->isNewRecord ? '新增用户' : '修改用户';

$form = SimpleAjaxForm::begin(['header' => $this->title]);

echo $form->field($model, 'cellphone');
echo $form->field($model, 'name');

SimpleAjaxForm::end();
