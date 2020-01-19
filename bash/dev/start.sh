#!/bin/bash

read -p "This will bootstrap the development environment. Are you sure to continue? (y|n) " -n 1 -r
echo    # (optional) move to a new line
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    exit 1
fi

# cd the app's root directory
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
APP_PATH="$(dirname $(dirname $DIR))"
cd $APP_PATH

# create an .env file:
cp .env.example .env

# build the docker containers
docker-compose up -d

# update the DATABASE_URL variable in the .env file
DB_DATABASE="$(cat .env | grep DB_DATABASE | cut -b 13-)"
DB_PASSWORD="$(cat .env | grep DB_PASSWORD | cut -b 13-)"
GATEWAY="$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.Gateway}}{{end}}' cheetah_mysql)"
sed -i "s/DATABASE_URL=.*/DATABASE_URL=mysql:\/\/root:${DB_PASSWORD}@${GATEWAY}:3306\/${DB_DATABASE}/g" .env

# install dependencies
docker exec -itu 1000:1000 cheetah_php_fpm composer install
