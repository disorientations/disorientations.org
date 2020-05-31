FROM php:7.2.30-fpm-alpine

RUN apk add autoconf pkgconf build-base poppler-utils git

RUN apk add imagemagick-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN apk add icu-dev \
    && docker-php-ext-install -j$(nproc) intl pdo pdo_mysql

RUN sed -i -e 's/listen = 127.0.0.1:9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf

RUN cd /bin \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar composer
