# Yii2 advanced template

新建项目

```bash
git clone https://github.com/krissss/yii2advanced xxx
# or
composer create-project kriss/yii2-advanced xxx
```

开发

```bash
# 安装依赖
composer install
yarn
# 初始化环境（dev）
php init
# 数据库迁移
php yii migrate
# 数据初始化
php yii init/init-data
# 权限初始化
php yii init-auth/restore
# 启动 php
composer serve
# 启动 vue
yarn serve
```

正式部署

```bash
# 安装依赖
composer install
yarn
# 初始化环境（prod）
php init
# 数据库迁移
php yii migrate
# 数据初始化
php yii init/init-data
# 权限初始化
php yii init-auth/restore
# 配置 nginx 访问 php
# 编译前端
yarn build
```

## use docker-compose

```bash
php init --env=dev --overwrite=all
# modify .env and docker-compose.yml
docker-compose up
docker-compose exec app composer install -vvv
docker-compose exec app php yii migrate
docker-compose exec app php yii init/init-data
docker-compose exec app php yii init-auth/restore
docker-compose exec app bash
```
