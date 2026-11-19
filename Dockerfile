FROM php:8.4-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        libonig-dev \
        unzip \
    && docker-php-ext-install -j"$(nproc)" mbstring pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs storage/app/private storage/app/public bootstrap/cache \
    && composer install --no-interaction --prefer-dist --optimize-autoloader \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
