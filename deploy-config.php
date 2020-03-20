<?php

return [
    'application' => 'app', // 项目名，会部署到对应目录下
    'git_ssh' => 'git@xxx.com/xxx.git', // git 地址，必须
    'default_env' => 'prod', // 默认环境
    'ask_before_start' => true, // 开始任务前是否确认
    'yii_auth_update' => false, // 是否有权限操作
    'envs' => [
        'prod' => [
            'branch' => 'master', // git branch
            'hostname' => 'prod.ip.com', // ssh 地址，每个 env 的 hostname 不能相同
            'ssh_user' => 'root', // ssh 用户
            'ssh_port' => 22, // ssh 端口
            'deploy_path' => '~/app', // 部署位置
            'keep_releases' => 5, // 保留版本数
        ],
        'dev' => [
            'branch' => 'master', // git branch
            'hostname' => 'dev.ip.com', // ssh 地址
            'ssh_user' => 'root', // ssh 用户
            'ssh_port' => 22, // ssh 端口
            'deploy_path' => '~/app', // 部署位置
            'keep_releases' => 5, // 保留版本数
        ],
    ],
];
