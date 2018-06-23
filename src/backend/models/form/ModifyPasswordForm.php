<?php

namespace backend\models\form;

use Yii;
use yii\base\Model;

class ModifyPasswordForm extends Model
{
    public $password;
    public $newPassword;
    public $newPasswordAgain;

    public function rules() {
        return [
            [['password', 'newPassword', 'newPasswordAgain'], 'required'],
            [['newPassword', 'newPasswordAgain'], 'string', 'min' => 6, 'max' => 16],
            [['newPassword'], 'match', 'pattern' => '/^[0-9]*[A-Za-z_!@#$%^&*()~+|]{1,}[0-9]*$/i', 'message' => '新密码过于简单'],
            [['newPasswordAgain'], 'compare', 'compareAttribute' => 'newPassword', 'message' => '两次密码输入不一致'],
            [['password'], 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'password' => '原密码',
            'newPassword' => '新密码',
            'newPasswordAgain' => '新密码重复',
        ];
    }

    public function validatePassword($attribute) {
        /** @var $admin \common\models\Admin */
        $admin = Yii::$app->user->getIdentity();
        if (!$admin->validatePassword($this->password)) {
            $this->addError($attribute, "原密码错误");
        }
    }

    public function modifyPassword() {
        /** @var $admin \common\models\Admin */
        $admin = Yii::$app->user->getIdentity();
        $admin->setPassword($this->newPassword);
        $admin->save(false);
        Yii::$app->user->logout();
    }
}