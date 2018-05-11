# 自用 yii2 advanced 模版

改自 v2.0.13

```bash
git clone https://github.com/krissss/yii2advanced xxx
cd xxx
php composer.phar install -vvv
php init --env=Development --overwrite=n
#修改数据库配置后，初始化数据
php yii migrate
php yii init/init-data
php init-auth/restore
```

前台：12345678910/123456

后台：admin/123456

# docker 开发环境启用

1. 在本机安装好 docker

2. 复制 .env-example 为 .env，并修改其中内容

3. docker-compose up

## 一些技巧

在容器启动后

composer：docker-compose exec docker-yii2-env composer -v

php: docker-compose exec docker-yii2-env php -v

