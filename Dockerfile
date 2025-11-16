# force rebuild v2

FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nodejs npm libicu-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y libpq-dev && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd intl opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --classmap-authoritative --no-interaction
RUN npm ci
RUN npm run build

RUN mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

RUN chmod -R 755 storage bootstrap/cache public/build && \
    chown -R www-data:www-data public/build || true

RUN php artisan storage:link || true

EXPOSE 10000

CMD sh -c "mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache public/build && chmod -R 755 storage bootstrap/cache public/build && php artisan serve --host=0.0.0.0 --port=$PORT"
