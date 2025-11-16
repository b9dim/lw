# force full rebuild v5.1
FROM php:8.2-cli

# Layer cache buster
ARG CACHE_BUSTER=5

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nodejs npm libicu-dev libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd intl opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Recopy app files (APP_REFRESH forces fresh copy)
ARG APP_REFRESH=5
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --classmap-authoritative --no-interaction

# Install Node dependencies & build assets
RUN npm ci
RUN npm run build

# Prepare Laravel directories
RUN mkdir -p storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    storage/logs \
    bootstrap/cache

# Permissions
RUN chmod -R 755 storage bootstrap/cache public/build && \
    chown -R www-data:www-data public/build || true

# Clear ALL caches to avoid HTTP/HTTPS confusion
RUN php artisan config:clear || true && \
    php artisan route:clear || true && \
    php artisan view:clear || true && \
    php artisan cache:clear || true

# No config:cache or route:cache in build!
# (To avoid Render HTTPS detection issues)

# Storage symlink
RUN php artisan storage:link || true

EXPOSE 10000

# Runtime: ensure folders exist, no caching, start server
CMD sh -c "\
    mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache public/build && \
    chmod -R 755 storage bootstrap/cache public/build && \
    php artisan serve --host=0.0.0.0 --port=\$PORT \
"
