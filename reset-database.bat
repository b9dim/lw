@echo off
chcp 65001 >nul
title Reset Database

echo.
echo ========================================
echo   Reset Database
echo ========================================
echo.
echo WARNING: This will delete all data!
echo.
set /p confirm="Are you sure? (yes/no): "
if /i not "%confirm%"=="yes" (
    echo Cancelled.
    pause
    exit /b 0
)

echo.
echo [*] Rolling back migrations...
php artisan migrate:rollback --step=100

echo.
echo [*] Running migrations...
php artisan migrate

echo.
echo [*] Seeding database...
php artisan db:seed

echo.
echo [OK] Database reset complete!
echo.
pause

