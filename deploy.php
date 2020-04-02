<?php
/**
 * @link https://deployer.org/
 * 安装:
 * 全局命令：composer global require deployer/deployer
 * 当前仓库：composer require deployer/deployer --dev
 * 注意：
 * windows 下使用注意：
 * 1. 必须使用 php 64位 版本，否则ssh不能调用：@link https://github.com/deployphp/deployer/issues/1725
 * 2. 不支持 tty，因此服务上需要先执行一次 git clone 来解除信任主机的提示
 * 其他注意：
 * repository 必须设置为使用 ssh 公钥部署的方式
 * branch 默认为 dep
 */

namespace Deployer;

$isWindows = strtolower(substr(PHP_OS, 0, 3)) === 'win';

require 'recipe/common.php';
$config = require 'deploy-config.php';

set('application', $config['application']);
set('git_tty', !$isWindows);
set('ssh_multiplexing', !$isWindows);
set('allow_anonymous_stats', false);

// 代码
set('repository', $config['git_ssh']);

// 文件权限
set('shared_files', []);
set('shared_dirs', ['runtime']);
set('writable_dirs', ['runtime']);

// 部署服务
set('default_stage', $config['default_env']);
foreach ($config['envs'] as $stage => $envConfig) {
    host($envConfig['hostname'])
        ->user($envConfig['ssh_user'])
        ->port($envConfig['ssh_port'])
        ->stage($stage)
        ->set('branch', $envConfig['branch'])
        ->set('deploy_path', rtrim($envConfig['deploy_path'], '/') . '/{{application}}')
        ->set('keep_releases', $envConfig['keep_releases']);
}

// 自定义任务
// 环境变量更新
task('yii:init', function () {
    run('{{bin/php}} {{release_path}}/init --env={{stage}} --overwrite=all');
})->desc('Initialization');

// 数据库迁移
task('yii:migrations', function () {
    run('{{bin/php}} {{release_path}}/yii migrate up --interactive=0');
})->desc('Run migrations');

// 权限更新
task('yii:auth_update', function () {
    run('{{bin/php}} {{release_path}}/yii init-auth/update-operations');
})->desc('Run migrations');

// 发布
task('deploy', function () use ($config) {
    invoke('deploy:info');

    if ($config['ask_before_start']) {
        if (!askConfirmation('confirm hostname and branch?', true)) {
            echo 'stop';
            return;
        }
    }

    invoke('deploy:prepare');
    invoke('deploy:lock');
    invoke('deploy:release');
    invoke('deploy:update_code');
    invoke('deploy:shared');
    invoke('deploy:writable');
    invoke('deploy:vendors');
    invoke('deploy:clear_paths');

    invoke('yii:init');
    invoke('yii:migrations');
    if ($config['yii_auth_update']) {
        invoke('yii:auth_update');
    }

    invoke('deploy:symlink');
    invoke('deploy:unlock');
    invoke('cleanup');
    invoke('success');
})->desc('Start Deploy');

// 失败后
after('deploy:failed', 'deploy:unlock');
