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