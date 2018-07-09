FROM daocloud.io/krissss/docker-yii2:php7.0.12-v1.0

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

# 修改目录权限
RUN set -ex \
    && for path in ${VOLUME_PATH} \
    ; do \
        mkdir -p "$path"; \
        chmod 0777 "$path"; \
        chown -R www-data:www-data "$path"; \
    done
