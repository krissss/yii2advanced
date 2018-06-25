<?php

namespace common\models;

use common\components\Tools;
use common\models\base\ActiveRecord;
use kriss\components\CellphoneValidator;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $cellphone
 * @property string $password_hash
 * @property string $name
 * @property string $auth_key
 * @property string $access_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property string $statusName
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_NORMAL = 0; // 正常
    const STATUS_DISABLE = 10; // 不可登录

    public static $statusData = [
        self::STATUS_NORMAL => '正常',
        self::STATUS_DISABLE => '不可登录',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cellphone', 'password_hash', 'name', 'auth_key'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['cellphone'], 'string', 'max' => 11],
            [['password_hash', 'name', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['cellphone'], 'unique'],
            [['cellphone'], CellphoneValidator::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cellphone' => '手机号',
            'password_hash' => '密码',
            'name' => '姓名',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['auth_key'], $fields['password_hash']);

        return $fields;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return $this->toName($this->status, static::$statusData);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->primaryKey;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 生成auth_key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Tools::generateRandString();
    }

    /**
     * 生成auth_key
     */
    public function generateAccessToken()
    {
        $this->access_token = Tools::generateRandString();
    }

    /**
     * 设置密码
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Tools::generatePasswordHash($password);
    }

    /**
     * 校验密码
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Tools::validatePassword($password, $this->password_hash);
    }

    /**
     * 重新刷新 accessToken
     * @param bool $save
     */
    public function refreshAccessToken($save = true)
    {
        $this->access_token = Tools::generateRandString();
        if ($save) {
            $this->save(false);
        }
    }
}
