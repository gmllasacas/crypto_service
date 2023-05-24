FROM php:8.1.19-fpm-alpine3.18

WORKDIR /var/www/html/

RUN apk update

RUN docker-php-ext-install bcmath

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .

RUN composer install