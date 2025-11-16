# force full rebuild v4
FROM php:8.2-cli

# Build argument to bust Docker cache
ARG CACHE_BUSTER=4

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nodejs npm libicu-dev libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd intl opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Force rebuild of COPY layer
ARG APP_REFRESH=4

# Copy application source
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --classmap-authoritative --no-interaction

# Install Node dependencies & build assets
RUN npm ci
RUN npm run build

# Create storage directories
RUN mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# Fix permissions
RUN chmod -R 755 storage bootstrap/cache public/build && \
    chown -R www-data:www-data public/build || true

# Create storage link
RUN php artisan storage:link || true

# Expose port
EXPOSE 10000

# No Laravel caching at build time — this is REQUIRED for Render
CMD sh -c "mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache public/build && chmod -R 755 storage bootstrap/cache public/build && php artisan serve --host=0.0.0.0 --port=\$PORT"
