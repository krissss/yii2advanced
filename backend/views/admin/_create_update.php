<?php
/** @var $this \yii\web\View */
/** @var $model \common\models\Admin */

use backend\widgets\SimpleAjaxForm;

$form = SimpleAjaxForm::begin(['header' => ($model->isNewRecord ? '创建' : '修改') . '管理员']);

echo $form->field($model, 'username');
echo $form->field($model, 'name')->label('姓名');
if ($model->isNewRecord) {
    echo $form->field($model, 'password_hash')->passwordInput();
}

$form->end();
