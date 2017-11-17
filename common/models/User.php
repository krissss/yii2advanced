<?php

namespace common\models;

use common\components\Tools;
use common\models\base\ActiveRecord;
use kriss\components\CellphoneValidator;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $cellphone
 * @property string $password_hash
 * @property string $name
 * @property string $auth_key
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

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['time_user'] = [
            'class' => 'kriss\components\TimeUserBehavior',
            'useUser' => false
        ];

        return $behaviors;
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
            [['password_hash', 'name', 'auth_key'], 'string', 'max' => 255],
            [['cellphone'], 'unique'],
            [['cellphone'], CellphoneValidator::className()],
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
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return $this->toName($this->status, self::$statusData);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
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
}
