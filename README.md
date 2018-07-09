# Yii2 advanced template

```php
composer create-project kriss/yii2-advanced xxx
# modify .env-project
php yii migrate
php yii init/init-data
php yii init-auth/restore
```

backend: admin/123456

## use docker-compose

```bash
cp .env-example .env
# modify .env and .env-project
docker-compose up
docker-compose exec docker-yii2-env composer install -vvv
docker-compose exec docker-yii2-env php yii migrate
docker-compose exec docker-yii2-env php yii init/init-data
docker-compose exec docker-yii2-env php yii init-auth/restore
```
