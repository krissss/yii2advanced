<?php
/**
 * @var yii\web\view $this
 * @var common\models\User $model
 */

use kriss\widgets\SimpleAjaxForm;

$this->title = $model->isNewRecord ? '新增用户' : '修改用户';

$form = SimpleAjaxForm::begin(['header' => $this->title]);

echo $form->field($model, 'cellphone');
echo $form->field($model, 'name');

SimpleAjaxForm::end();
