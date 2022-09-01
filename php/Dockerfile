FROM php:5.4.45-apache

WORKDIR /var/www

RUN docker-php-ext-install mysql && \ 
    docker-php-ext-enable mysql

RUN chown -R www-data:www-data /var/www

EXPOSE 80
