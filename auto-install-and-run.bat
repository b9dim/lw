@echo off
chcp 65001 >nul
title Auto Install and Run - Law Firm Project

echo.
echo ========================================
echo   تثبيت وتشغيل المشروع تلقائياً
echo ========================================
echo.

REM إنشاء مجلد PHP المحمول
if not exist "php-portable" mkdir php-portable

REM التحقق من وجود PHP المحمول
if not exist "php-portable\php.exe" (
    echo [*] جاري تنزيل PHP محمول...
    echo [*] قد يستغرق هذا بضع دقائق...
    echo.
    
    powershell -ExecutionPolicy Bypass -Command "Invoke-WebRequest -Uri 'https://windows.php.net/downloads/releases/php-8.2.13-Win32-vs16-x64.zip' -OutFile 'php.zip' -UseBasicParsing"
    
    if exist php.zip (
        powershell -ExecutionPolicy Bypass -Command "Expand-Archive -Path 'php.zip' -DestinationPath 'php-portable' -Force"
        del php.zip
        
        REM نسخ ملف php.ini
        if exist "php-portable\php.ini-development" (
            copy "php-portable\php.ini-development" "php-portable\php.ini" >nul
        )
        
        echo [OK] تم تثبيت PHP محمول
    ) else (
        echo [X] فشل تنزيل PHP
        echo [*] يرجى تثبيت Laragon من: https://laragon.org/download/
        pause
        exit /b 1
    )
) else (
    echo [OK] PHP محمول موجود
)

REM إضافة PHP إلى PATH مؤقتاً
set PATH=%~dp0php-portable;%PATH%

REM التحقق من Node.js
where node >nul 2>&1
if errorlevel 1 (
    echo [X] Node.js غير مثبت
    echo [*] يرجى تثبيته من: https://nodejs.org/
    echo [*] أو استخدم Docker: docker-compose up -d
    pause
    exit /b 1
)

echo [OK] Node.js موجود
echo.

REM تثبيت Composer محلياً
if not exist "composer.phar" (
    echo [*] جاري تثبيت Composer...
    php-portable\php.exe -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php-portable\php.exe composer-setup.php
    del composer-setup.php 2>nul
    
    if exist composer.phar (
        echo [OK] تم تثبيت Composer
    ) else (
        echo [X] فشل تثبيت Composer
        pause
        exit /b 1
    )
) else (
    echo [OK] Composer موجود
)

echo.

REM التحقق من ملف .env
if not exist .env (
    echo [*] إنشاء ملف .env...
    copy .env.example .env >nul 2>&1
    if not exist .env (
        echo [X] ملف .env غير موجود
        echo [*] يرجى إنشاء ملف .env وإضافة بيانات قاعدة البيانات
        pause
        exit /b 1
    )
)

echo [OK] ملف .env موجود
echo.

REM تثبيت مكتبات PHP
if not exist vendor (
    echo [*] تثبيت مكتبات PHP (قد يستغرق بضع دقائق)...
    php-portable\php.exe composer.phar install --no-interaction
    if errorlevel 1 (
        echo [X] فشل تثبيت مكتبات PHP
        pause
        exit /b 1
    )
) else (
    echo [OK] مكتبات PHP مثبتة
)

echo.

REM تثبيت مكتبات JavaScript
if not exist node_modules (
    echo [*] تثبيت مكتبات JavaScript...
    npm install
    if errorlevel 1 (
        echo [X] فشل تثبيت مكتبات JavaScript
        pause
        exit /b 1
    )
) else (
    echo [OK] مكتبات JavaScript مثبتة
)

echo.

REM توليد مفتاح التطبيق
echo [*] توليد مفتاح التطبيق...
php-portable\php.exe artisan key:generate >nul 2>&1

REM بناء الأصول
if not exist "public\build" (
    echo [*] بناء الأصول...
    npm run build
)

echo.
echo ========================================
echo [OK] كل شيء جاهز!
echo ========================================
echo.
echo [*] ملاحظة: يجب إنشاء قاعدة بيانات MySQL باسم 'law_firm'
echo [*] ثم تعديل ملف .env وإضافة بيانات قاعدة البيانات
echo.
echo [*] بعد ذلك، شغّل: php-portable\php.exe artisan migrate --seed
echo [*] ثم شغّل: php-portable\php.exe artisan serve
echo.
echo أو شغّل: start.bat
echo.

pause

