<?php
/**
 * @var yii\web\View $this
 * @var common\models\Admin $model
 */

use kriss\widgets\SimpleAjaxForm;

$form = SimpleAjaxForm::begin(['header' => '重置密码']);

echo $form->field($model, 'password_hash')->passwordInput(['value' => '']);

$form->end();
