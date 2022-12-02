FROM php:8-apache
RUN apt-get update
RUN a2enmod authn_dbd # подключаем модуль для аутентификации юзеров с помощью поиска их в sql таблицах
RUN a2enmod rewrite
RUN apt-get install -y apache2-utils libaprutil1-dbd-mysql # содержит драйвер базы данных MySQL/mariadb
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN pecl install redis && docker-php-ext-enable redis
#RUN apt-get -y install mariadb-client