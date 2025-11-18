@echo off
chcp 65001 >nul
title Fix Storage Directories

echo.
echo ========================================
echo   Creating Storage Directories
echo ========================================
echo.

REM Create storage directories
if not exist "storage\framework" mkdir "storage\framework"
if not exist "storage\framework\views" mkdir "storage\framework\views"
if not exist "storage\framework\cache" mkdir "storage\framework\cache"
if not exist "storage\framework\cache\data" mkdir "storage\framework\cache\data"
if not exist "storage\framework\sessions" mkdir "storage\framework\sessions"
if not exist "storage\logs" mkdir "storage\logs"
if not exist "bootstrap\cache" mkdir "bootstrap\cache"

echo [OK] Storage directories created
echo.

REM Create .gitkeep files
echo. > storage\framework\views\.gitkeep
echo. > storage\framework\cache\data\.gitkeep
echo. > storage\framework\sessions\.gitkeep
echo. > storage\logs\.gitkeep
echo. > bootstrap\cache\.gitkeep

echo [OK] .gitkeep files created
echo.

REM Clear cache
echo [*] Clearing cache...
php artisan cache:clear >nul 2>&1
php artisan view:clear >nul 2>&1
php artisan config:clear >nul 2>&1

echo [OK] Cache cleared
echo.
echo ========================================
echo   Done!
echo ========================================
echo.
pause

