FROM php:8.2-fpm

# システム依存パッケージのインストール
RUN apt-get update && \
    apt-get install -y git unzip libpng-dev libonig-dev libxml2-dev zip curl && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD php artisan serve --host=0.0.0.0 --port=8000
