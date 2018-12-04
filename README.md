# Yii2 advanced template

```php
composer create-project kriss/yii2-advanced xxx
# modify .env
php yii migrate
php yii init/init-data
php yii init-auth/restore
```

backend: admin/123456

## use docker-compose

```bash
cp .env-example .env
# modify .env
docker-compose up
docker-compose exec app composer install -vvv
docker-compose exec app php yii migrate
docker-compose exec app php yii init/init-data
docker-compose exec app php yii init-auth/restore
docker-compose exec app bash
```
