# 自用 yii2 advanced 模版

改自 v2.0.*

```bash
git clone https://github.com/krissss/yii2advanced xxx
cd xxx
cp .env-example .env
cp .env-project-example .env-project
# 手动修改 .env 和 .env-project 中的配置信息
docker-compose up
docker-compose exec docker-yii2-env composer install -vvv
docker-compose exec docker-yii2-env php yii migrate
docker-compose exec docker-yii2-env php yii init/init-data
docker-compose exec docker-yii2-env php yii init-auth/restore
```

前台：12345678910/123456

后台：admin/123456
