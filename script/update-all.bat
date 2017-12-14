@echo off
echo %date%%time%

cd ../
echo -----project-----
git pull
echo -----composer-----
php composer.phar install

cmd