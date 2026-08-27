# e-shop (Sistem Pengadaan Tender BPR Bangli) — Laravel 12
FROM php:8.4-apache

# System deps + PHP extensions (Laravel 12 + composer.lock requirements)
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
        libonig-dev libxml2-dev libicu-dev libcurl4-openssl-dev pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Dependencies first (cache layer)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# App source
COPY . .

# Finish composer (autoload + scripts) & permissions
RUN composer install --no-dev --prefer-dist \
    && php artisan package:discover --ansi || true \
    && mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R u+rwX,go+rX /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Apache vhost: docroot = public/, index.php
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Entrypoint: buat .env dari env vars + migrate fresh seed + start apache
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
