<?php

namespace common\components;

use kriss\envGenerator\Env;
use kriss\envGenerator\Generator;

class EnvGenerator extends Generator
{
    /**
     * 生成文件，可以使用如下方法辅助
     * fileGenerate($env, $fileName, $content)：文件生成
     *
     * @param array $config
     * @param string $env
     * @param Env $envObj
     */
    protected function generateFiles($config, $env, $envObj)
    {
        $commonHeader = $this->commonHeader($envObj, '#');

        $content = $this->getEnvProject($config);
        $this->fileGenerate($env, '.env', implode("\n", [$commonHeader, $content]));

        $content = $this->getDockerCompose($config);
        $this->fileGenerate($env, 'docker-compose.yml', implode("\n", [$commonHeader, $content]));
    }

    /**
     * 公用的头信息
     * @param Env $envObj
     * @param string $commentStr
     * @return string
     */
    protected function commonHeader(Env $envObj, $commentStr = '#')
    {
        $thisFile = __CLASS__;
        return <<<EOL
{$commentStr} 由 {$thisFile} 生成，可以修改参数值，不要直接修改参数属性
{$commentStr} {$envObj->desc}
EOL;
    }

    protected function getEnvProject($config)
    {
        $project = $config['project'];
        $content = <<<EOL
# 应用环境
    
# Yii 环境
YII_DEBUG={$project['yiiDebug']}
YII_ENV={$project['yiiEnv']}

# Request Cookie
COOKIE_KEY={$project['cookieKey']}

# 数据库
DB_DSN={$project['db']['dsn']}
DB_USERNAME={$project['db']['username']}
DB_PASSWORD={$project['db']['password']}

# redis
REDIS_HOST={$project['redis']['host']}
REDIS_PORT={$project['redis']['port']}
REDIS_PASSWORD={$project['redis']['password']}
REDIS_DB_SESSION={$project['redis']['dbSession']}
REDIS_DB_CACHE={$project['redis']['dbCache']}

EOL;
        return $content;
    }

    protected function getDockerCompose($config)
    {
        $app = $config['docker']['app'];
        $mysql = $config['docker']['mysql'];
        $redis = $config['docker']['redis'];

        $comment = [
            'nginxConf' => $app['hasNginxConf'] ? '' : '#',
            'phpConf' => $app['hasPhpConf'] ? '' : '#',
            'supervisorConf' => $app['hasSupervisorConf'] ? '' : '#',
            'mysql' => $mysql['use'] ? '' : '#',
            'mysqlConf' => $mysql['hasMysqlConf'] ? '' : '#',
            'redis' => $redis['use'] ? '' : '#',
            'redisBind' => $redis['bind'] ? '' : '#',
            'redisPassword' => $redis['password'] ? '' : '#',
        ];

        $appYML = <<<YML
  {$app['name']}:
    image: {$app['image']}:{$app['version']}
    ports:
      - {$app['port']}:80
    volumes:
      - {$app['appPath']}:/app
      {$comment['nginxConf']}- {$app['appPath']}/docker/nginx:/etc/nginx/conf.d:ro
      {$comment['phpConf']}- {$app['appPath']}/docker/php/php.ini:/usr/local/etc/php/conf.d/php.ini:ro
      {$comment['supervisorConf']}- {$app['appPath']}/docker/supervisor/queue.conf:/etc/supervisor/conf.d/queue.conf:ro
      - {$app['composerPath']}:/tmp:ro
    links:
      {$comment['mysql']}- {$config['docker']['mysql']['name']}
      {$comment['redis']}- {$config['docker']['redis']['name']}
YML;

        $mysqlYML = $comment['mysql'] ? '' : <<<YML
  {$mysql['name']}:
    image: {$mysql['image']}:{$mysql['version']}
    ports:
      - {$mysql['port']}:3306
    volumes:
      - {$mysql['dataPath']}:/var/lib/mysql
      {$comment['mysqlConf']}- {$app['appPath']}/docker/mysql:/etc/mysql/conf.d
    environment:
      - MYSQL_ROOT_PASSWORD={$mysql['rootPassword']}
      - MYSQL_DATABASE={$mysql['database']}
      - MYSQL_USER={$mysql['user']}
      - MYSQL_PASSWORD={$mysql['password']}
YML;

        $redisYML = $comment['redis'] ? '' : <<<YML
  {$redis['name']}:
    image: {$redis['image']}:{$redis['version']}
    ports:
      - {$redis['port']}:6379
    volumes:
      - {$redis['dataPath']}:/data
    command: >
      {$comment['redisBind']}--bind {$redis['bind']}
      {$comment['redisPassword']}--requirepass {$redis['password']}
YML;

        $content = <<<EOL
version: '2'

services:
{$appYML}
{$mysqlYML}
{$redisYML}

EOL;
        return $content;
    }
}
