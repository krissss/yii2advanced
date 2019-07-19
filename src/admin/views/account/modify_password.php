<?php
/**
 * @var $this yii\web\View
 * @var $model admin\forms\ModifyPasswordForm
 */

use kriss\widgets\SimpleActiveForm;

$this->title = '修改密码';
$this->params['breadcrumbs'] = [
    $this->title,
];

$form = SimpleActiveForm::begin([
    'title' => '修改密码'
]);

echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'newPassword')->passwordInput();
echo $form->field($model, 'newPasswordAgain')->passwordInput();

$form->end();
