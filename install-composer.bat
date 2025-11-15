@echo off
echo ========================================
echo تثبيت Composer على Windows
echo ========================================
echo.

REM التحقق من وجود PHP
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo [خطأ] PHP غير مثبت أو غير موجود في PATH
    echo.
    echo يرجى تثبيت XAMPP أو Laragon أولاً
    echo أو إضافة PHP إلى PATH
    echo.
    pause
    exit /b 1
)

echo [✓] PHP موجود
php -v
echo.

REM تنزيل Composer
echo [*] جاري تنزيل Composer...
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

if exist composer.phar (
    echo [✓] تم تثبيت Composer بنجاح!
    echo.
    echo يمكنك استخدام: php composer.phar install
    echo أو انسخ composer.phar إلى مجلد PHP وأضفه إلى PATH
) else (
    echo [خطأ] فشل تثبيت Composer
)

echo.
pause

