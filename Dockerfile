FROM php:8.2-cli

# تثبيت المتطلبات
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت PostgreSQL dependencies
RUN apt-get update && apt-get install -y libpq-dev && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت ملحقات PHP (PostgreSQL + MySQL للتوافق)
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إنشاء مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . /var/www/html

# تثبيت المتطلبات
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm ci
RUN npm run build

# Cache Laravel
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# إنشاء storage link
RUN php artisan storage:link || true

# تعيين الصلاحيات
RUN chmod -R 755 storage bootstrap/cache

EXPOSE $PORT
CMD php artisan serve --host=0.0.0.0 --port=$PORT

