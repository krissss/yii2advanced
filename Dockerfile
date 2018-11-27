FROM hub.tencentyun.com/kriss/docker-yii2:7.1-master

# 设置项目目录
WORKDIR /app

# 复制代码到项目目录
COPY . /app
# 项目配置
COPY ./docker/.env-project /app/.env-project
# php
COPY ./docker/php/php.ini /usr/local/etc/php
# supervisor
#COPY ./docker/supervisor/*.conf /etc/supervisor/conf.d/
# nginx
COPY ./docker/nginx/vhost.conf /etc/nginx/conf.d/vhost.conf

# 定义环境变量
ENV YII_MIGRATION_DO=1 \
    VOLUME_PATH=/app/runtime\ /app/public

# 暴露前后台端口
EXPOSE 80
