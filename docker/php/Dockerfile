FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo_mysql mysqli

RUN apk add --no-cache \
    icu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY .env /var/www/html/.env

EXPOSE 9000

CMD ["php-fpm"]