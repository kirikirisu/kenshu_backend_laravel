FROM php:8.2-fpm

RUN apt-get update
RUN apt-get -y install git zip unzip vim \
      && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
      && apt-get install -y nodejs

RUN docker-php-ext-install pdo_mysql

RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

WORKDIR /var/www/html
