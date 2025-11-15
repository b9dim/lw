FROM php:8.2-cli

# تثبيت المتطلبات (بما في ذلك intl)
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
    libicu-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت PostgreSQL dependencies
RUN apt-get update && apt-get install -y libpq-dev && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت ملحقات PHP (PostgreSQL + MySQL للتوافق + intl للعربية)
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd intl

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

# إنشاء مجلدات storage المطلوبة
RUN mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# تعيين الصلاحيات (بما في ذلك مجلد build للأصول)
RUN chmod -R 755 storage bootstrap/cache public/build

# إنشاء storage link
RUN php artisan storage:link || true

# لا نعمل cache في البناء - سنعمله في runtime
# RUN php artisan config:cache || true
# RUN php artisan route:cache || true
# RUN php artisan view:cache || true

EXPOSE 10000

# استخدام sh -c لضمان معالجة متغيرات البيئة بشكل صحيح
# إنشاء مجلدات storage في runtime (للتأكد من وجودها)
# إزالة view:cache لأنه يسبب خطأ "View path not found"
# التأكد من وجود مجلد build وصلاحياته
CMD sh -c "mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache public/build && chmod -R 755 storage bootstrap/cache public/build && php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=\$PORT"
