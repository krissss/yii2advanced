<?php

namespace backend\models\form;

use common\models\Admin;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;

    /**
     * @var Admin
     */
    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
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
     * @return Admin
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::find()->where(['username' => $this->username])->one();
        }
        return $this->_user;
    }
}