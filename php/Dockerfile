FROM php:8.2-fpm

RUN apt-get -y update && \
  apt-get install -y wget gnupg2
RUN apt-get update && apt-get install -y libpq-dev zlib1g-dev g++ msmtp msmtp-mta git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_pgsql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

WORKDIR /var/www/project

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash