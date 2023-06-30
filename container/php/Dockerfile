FROM php:fpm-buster

RUN apt-get update
RUN apt-get -y install git zip unzip vim
RUN docker-php-ext-install pdo_mysql

RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

WORKDIR /var/www/html
