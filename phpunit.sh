#!/usr/bin/env bash

cd "$(dirname "$0")"

docker-compose exec php-zend-app vendor/bin/phpunit "$@"
