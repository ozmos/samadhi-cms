FROM php:7.3-apache

LABEL maintainer="osamumorozumi@gmail.com"

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli