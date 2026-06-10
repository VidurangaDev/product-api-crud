FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    zip unzip curl git libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["php-fpm"]
