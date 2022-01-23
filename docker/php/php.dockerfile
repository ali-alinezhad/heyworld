FROM php:7.4.20-fpm-alpine3.13

RUN addgroup -g 1000 heyworld && adduser -u 1000 -G heyworld -g heyworld -s /bin/sh -D heyworld

RUN mkdir -p /var/www/html

RUN chown heyworld:heyworld /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql
