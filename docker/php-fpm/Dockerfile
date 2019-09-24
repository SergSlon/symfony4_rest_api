ARG VERSION

# ======== Dev image ========
FROM php:${VERSION}-fpm-alpine AS dev

## Install system dependencies
RUN apk update && \
    apk add --no-cache --virtual dev-deps git autoconf gcc g++ make && \
    apk add --no-cache zlib-dev libzip-dev &&\
    apk add --no-cache mysql-client curl libmcrypt libmcrypt-dev openssh-client icu-dev &&\
    apk add --no-cache libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev

## Install php extensions
RUN yes | pecl install xdebug && \
    echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/xdebug.ini && \
#    echo "xdebug.remote_mode=req" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.idekey=Docker" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo_mysql zip soap intl

## Copy php default configuration
COPY ./docker/php-fpm/default.ini /usr/local/etc/php/conf.d/default.ini

ADD ./docker/php-fpm/aliases.sh /etc/profile.d/aliases.sh

ENV APP_ENV=dev
WORKDIR /app

## Install composer
RUN wget https://getcomposer.org/installer && \
    php installer --install-dir=/usr/local/bin/ --filename=composer && \
    rm installer && \
    composer global require hirak/prestissimo

RUN apk add mc

# ======== Test image ========
FROM dev AS test

WORKDIR /app

## Copy project files to workdir
COPY . .

## Install application dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction --optimize-autoloader

## Change files owner to php-fpm default user
RUN chown -R www-data:www-data .
RUN chmod -R 777 /app/var/cache /app/var/logs /app/var/sessions

# ======== Prod image ========
FROM test AS prod

ENV APP_ENV=prod
WORKDIR /app

## Remove dev dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

## Disable xdebug on production
RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

## Cleanup
RUN apk del dev-deps && \
    composer global remove hirak/prestissimo && \
    rm /usr/local/bin/composer

