FROM php:7.2-fpm-alpine
WORKDIR /app

RUN docker-php-ext-install pdo pdo_mysql mysqli && \
    docker-php-ext-enable pdo_mysql mysqli

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.7.0 \
    && docker-php-ext-enable xdebug