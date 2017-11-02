<?php

namespace frontend\models\form;

use common\models\User;
use kriss\components\CellphoneValidator;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $cellphone;
    public $password;
    public $rememberMe = false;

    /**
     * @var User
     */
    private $_user;

    public function rules()
    {
        return [
            [['cellphone', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['cellphone', CellphoneValidator::className()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cellphone' => '手机号',
            'password' => '密码',
            'rememberMe' => '记住密码',
        ];
    }

    /**
     * rules
     * @param $attribute
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '密码错误');
            }
        }
    }

    /**
     * 登录
     * @return mixed
     */
    public function login()
    {
        $user = $this->getUser();
        $isLogin = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        if($isLogin){
            return $user;
        }
        return false;
    }

    /**
     * 获取用户
     * @return User
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::find()->where(['cellphone' => $this->cellphone])->one();
        }
        return $this->_user;
    }
}