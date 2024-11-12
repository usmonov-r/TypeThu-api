# (FastCGI Process Manager)
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/api

COPY composer.json composer.lock ./

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts

EXPOSE 9000

#PHP-FPM when the container runs
CMD ["php-fpm"]
