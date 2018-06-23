<?php

class m171102_084733_init_user extends \console\migrations\Migration
{
    public function safeUp()
    {
        $this->createTable('admin', array_merge([
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('登录名'),
            'password_hash' => $this->string()->notNull()->comment('密码'),
            'name' => $this->string()->notNull()->comment('管理员姓名'),
            'auth_key' => $this->string()->notNull()->comment('Auth Key'),
        ], $this->commonColumns([
            'status', 'created_at', 'created_by', 'updated_at', 'updated_by'
        ])
        ), $this->setTableComment('管理员表'));

        $this->createTable('user', array_merge([
            'id' => $this->primaryKey(),
            'cellphone' => $this->string(11)->notNull()->unique()->comment('手机号'),
            'password_hash' => $this->string()->notNull()->comment('密码'),
            'name' => $this->string()->notNull()->comment('姓名'),
            'auth_key' => $this->string()->notNull()->comment('Auth Key'),
        ], $this->commonColumns([
            'status', 'created_at', 'updated_at',
        ])
        ), $this->setTableComment('用户表'));
    }

    public function safeDown()
    {
        echo "m171102_084733_init_user cannot be reverted.\n";

        return false;
    }
}
