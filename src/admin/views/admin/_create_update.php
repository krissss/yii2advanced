<?php
/**
 * @var yii\web\View $this
 * @var common\models\Admin $model
 */

use kriss\widgets\SimpleAjaxForm;

$this->title = ($model->isNewRecord ? '创建' : '修改') . '管理员';
$form = SimpleAjaxForm::begin(['header' => $this->title]);

echo $form->field($model, 'username');
echo $form->field($model, 'name')->label('姓名');
if ($model->isNewRecord) {
    echo $form->field($model, 'password_hash')->passwordInput();
}

$form->end();
