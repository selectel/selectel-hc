#!/bin/bash

cd app

./version-hook.sh VERSION

echo "VER: $(cat VERSION)"

source .env

docker build -f Dockerfile-base -t ${DOCKER_REGISTRY}/selectel-hc:base .

docker build -t ${DOCKER_REGISTRY}/selectel-hc:latest .
docker tag ${DOCKER_REGISTRY}/selectel-hc:latest ${DOCKER_REGISTRY}/selectel-hc:$(cat VERSION)

docker push ${DOCKER_REGISTRY}/selectel-hc:latest
docker push ${DOCKER_REGISTRY}/selectel-hc:$(cat VERSION)
