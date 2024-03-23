FROM php:8.3-fpm-alpine

RUN apk update \
    && apk add --no-cache git mysql-client libzip-dev curl libmcrypt libmcrypt-dev openssh-client icu-dev rabbitmq-c \
       rabbitmq-c-dev imap-dev libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf openssl-dev \
       sqlite-dev unzip bash git shadow \
    && docker-php-source extract \
    && docker-php-source delete \
    && docker-php-ext-install pdo pdo_mysql soap intl zip imap \
    && rm -rf /tmp/*

RUN apk add --no-cache libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev libmcrypt-dev freetype-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" gd \
    && docker-php-ext-enable gd

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data \
    && usermod -o -u ${PUID} -g www-data www-data


ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer



CMD ["php-fpm", "-F"]

USER www-data
WORKDIR /var/www/html

EXPOSE 9000
