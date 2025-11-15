@echo off
chcp 65001 >nul
echo ========================================
echo إعداد المشروع
echo ========================================
echo.

REM التحقق من PHP
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo [✗] PHP غير مثبت أو غير موجود في PATH
    echo.
    echo يرجى تثبيت Laragon أو XAMPP أولاً:
    echo Laragon: https://laragon.org/download/
    echo XAMPP: https://www.apachefriends.org/download.html
    echo.
    pause
    exit /b 1
)

echo [✓] PHP موجود
php -v
echo.

REM التحقق من Composer
where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo [✗] Composer غير مثبت
    echo [*] جاري محاولة التثبيت...
    echo.
    
    REM محاولة تثبيت Composer محلياً
    if exist composer.phar (
        echo [*] استخدام composer.phar المحلي
        php composer.phar install
        goto :npm_check
    )
    
    echo [*] تنزيل Composer...
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    
    if exist composer.phar (
        echo [✓] تم تثبيت Composer محلياً
        php composer.phar install
        goto :npm_check
    ) else (
        echo [✗] فشل تثبيت Composer
        echo [*] يرجى تثبيته يدوياً من: https://getcomposer.org/download/
        pause
        exit /b 1
    )
) else (
    echo [✓] Composer موجود
    composer --version
    echo.
    echo [*] جاري تثبيت مكتبات PHP...
    composer install
)

:npm_check
echo.

REM التحقق من Node.js
where node >nul 2>&1
if %errorlevel% neq 0 (
    echo [✗] Node.js غير مثبت
    echo [*] يرجى تثبيته من: https://nodejs.org/
    echo.
    pause
    exit /b 1
)

echo [✓] Node.js موجود
node -v
npm -v
echo.

echo [*] جاري تثبيت مكتبات JavaScript...
npm install

echo.
echo ========================================
echo [✓] تم إعداد المشروع بنجاح!
echo ========================================
echo.
echo الخطوات التالية:
echo 1. عدّل ملف .env وأضف بيانات قاعدة البيانات
echo 2. أنشئ قاعدة بيانات MySQL باسم: law_firm
echo 3. نفّذ: php artisan key:generate
echo 4. نفّذ: php artisan migrate --seed
echo 5. نفّذ: npm run dev (أو npm run build)
echo 6. نفّذ: php artisan serve
echo.
pause

