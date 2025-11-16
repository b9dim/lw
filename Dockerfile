# force full rebuild v5
FROM php:8.2-cli

# bust Docker build cache layer
ARG CACHE_BUSTER=5

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nodejs npm libicu-dev libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd intl opcache

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# copy app files (buster ensures no cache)
ARG APP_REFRESH=5
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --classmap-authoritative --no-interaction

# Install Node dependencies and build assets
RUN npm ci
RUN npm run build

# Prepare Laravel directories
RUN mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# Laravel file permissions
RUN chmod -R 755 storage bootstrap/cache public/build && \
    chown -R www-data:www-data public/build || true

# Clear all Laravel caches (important!)
RUN php artisan config:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true \
    && php artisan cache:clear || true

# No build-time caching of config here — avoid mixing HTTP/HTTPS
# RUN php artisan config:cache 
# RUN php artisan route:cache

# Storage link
RUN php artisan storage:link || true

EXPOSE 10000

# Runtime command — no caches generated here
CMD sh -c "mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache public/build && chmod -R 755 storage bootstrap/cache public/build && php artisan serve --host=0.0.0.0 --port=\$PORT"
