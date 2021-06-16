#!/bin/bash
source .env

cd app

[[ $1 == '--no-vers-up' ]] || ./version-hook.sh VERSION

echo "VER: $(cat VERSION)"

if [[ `uname -m` == 'arm64' ]]; then
    DOCKER_ARGS="buildx build --platform linux/amd64 --push"
    echo "<<< [ Warn ] Build in M1 Chip"
else
    DOCKER_ARGS="build"
fi

docker ${DOCKER_ARGS} -f Dockerfile-base -t ${DOCKER_REGISTRY}/selectel-hc:base .

docker ${DOCKER_ARGS} -t ${DOCKER_REGISTRY}/selectel-hc:latest .
docker ${DOCKER_ARGS} -t ${DOCKER_REGISTRY}/selectel-hc:$(cat VERSION) .


[[ ${DOCKER_ARGS} == 'build' ]] && {
  docker tag ${DOCKER_REGISTRY}/selectel-hc:latest ${DOCKER_REGISTRY}/selectel-hc:$(cat VERSION)

  docker push ${DOCKER_REGISTRY}/selectel-hc:latest
  docker push ${DOCKER_REGISTRY}/selectel-hc:$(cat VERSION)
}
