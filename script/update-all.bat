@echo off
echo %date%%time%

cd ../
echo -----project-----
git pull
echo -----composer-----
php composer.phar install
echo -----kriss-----
cd ./kriss
git pull

cmd