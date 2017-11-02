@echo off
cd ../

git pull

git clone https://github.com/krissss/yii2-common-tools kriss

php composer.phar install -vvv

php init --env=Development --overwrite=n

pause