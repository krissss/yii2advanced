imageRegistry="daocloud.io/xuejike/yii2advanced"
dockerServer="daocloud.io"
dockerUserName="krissss"

tagTime=$(date +%Y%m%d);
tag="${tagTime}-${BUILD_NUMBER}"

# 登陆 Docker 镜像库
# @link https://docs.docker.com/engine/reference/commandline/login/#provide-a-password-using-stdin
# @use cat password.txt | ./build-upload.sh
docker login --username=$dockerUserName --password-stdin $dockerServer

tagImage="${imageRegistry}:${tag}"
lastImage="${imageRegistry}:latest"

docker build -t $tagImage ../
if [ $? -eq 0 ];then
  echo "镜像构建成功"
else
  echo "镜像构建失败"
  return -1;
fi

docker tag $tagImage $lastImage

docker push $tagImage
docker push $lastImage
echo "上传完成"
docker rmi ${tagImage}
docker rmi ${lastImage}
echo "清除Docker"

docker logout $dockerServer
