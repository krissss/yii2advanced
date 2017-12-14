@echo off
cd ../

git pull

php composer.phar install -vvv

php init --env=Development --overwrite=n

pause