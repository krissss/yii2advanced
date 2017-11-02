@echo off
cd ../kriss
git fetch --all && git reset --hard origin/master && git pull
pause