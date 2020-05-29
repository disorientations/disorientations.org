FROM php:7.2.30-fpm-alpine

RUN apk add autoconf pkgconf build-base poppler-utils

RUN apk add imagemagick-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql

RUN sed -i -e 's/listen = 127.0.0.1:9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf
