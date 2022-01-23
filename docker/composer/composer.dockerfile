FROM composer:2.1.1

RUN addgroup -g 1000 heyworld && adduser -u 1000 -G heyworld -g heyworld -s /bin/sh -D heyworld

WORKDIR /var/www/html
