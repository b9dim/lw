@echo off
chcp 65001 >nul
echo ========================================
echo فحص المتطلبات
echo ========================================
echo.

REM فحص PHP
where php >nul 2>&1
if %errorlevel% equ 0 (
    echo [✓] PHP مثبت
    php -v | findstr /C:"PHP"
) else (
    echo [✗] PHP غير مثبت
    echo    يرجى تثبيت XAMPP أو Laragon
)
echo.

REM فحص Composer
where composer >nul 2>&1
if %errorlevel% equ 0 (
    echo [✓] Composer مثبت
    composer --version
) else (
    echo [✗] Composer غير مثبت
    echo    شغّل install-composer.bat أو ثبّت Composer يدوياً
)
echo.

REM فحص Node.js
where node >nul 2>&1
if %errorlevel% equ 0 (
    echo [✓] Node.js مثبت
    node -v
    npm -v
) else (
    echo [✗] Node.js غير مثبت
    echo    حمّل من: https://nodejs.org/
)
echo.

REM فحص MySQL
where mysql >nul 2>&1
if %errorlevel% equ 0 (
    echo [✓] MySQL موجود في PATH
) else (
    echo [!] MySQL قد يكون مثبتاً ولكن غير موجود في PATH
    echo    إذا كنت تستخدم XAMPP، تأكد من تشغيل MySQL من XAMPP Control Panel
)
echo.

echo ========================================
pause

