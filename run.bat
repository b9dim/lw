@echo off
chcp 65001 >nul
title Run Project
color 0A

echo.
echo ========================================
echo    Law Firm Project
echo    Starting Application
echo ========================================
echo.

REM Check PHP
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo [X] PHP is not installed
    echo.
    echo Please install one of the following:
    echo.
    echo 1. Laragon (Recommended - Easiest):
    echo    https://laragon.org/download/
    echo.
    echo 2. XAMPP:
    echo    https://www.apachefriends.org/download.html
    echo.
    echo 3. Docker Desktop:
    echo    https://www.docker.com/products/docker-desktop/
    echo    Then run: docker-compose up -d
    echo.
    echo After installation, run this file again
    echo.
    pause
    exit /b 1
)

echo [OK] PHP found
php -v
echo.

REM Check Composer
where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo [X] Composer is not installed
    echo [*] Attempting local installation...
    
    if exist composer.phar (
        echo [*] Using local composer.phar
        set COMPOSER_CMD=php composer.phar
    ) else (
        echo [*] Downloading Composer...
        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        php composer-setup.php
        php -r "unlink('composer-setup.php');"
        
        if exist composer.phar (
            echo [OK] Composer installed locally
            set COMPOSER_CMD=php composer.phar
        ) else (
            echo [X] Failed to install Composer
            echo [*] Please install from: https://getcomposer.org/download/
            pause
            exit /b 1
        )
    )
) else (
    echo [OK] Composer found
    composer --version
    set COMPOSER_CMD=composer
)

echo.

REM Check Node.js
where node >nul 2>&1
if %errorlevel% neq 0 (
    echo [X] Node.js is not installed
    echo [*] Please install from: https://nodejs.org/
    echo.
    pause
    exit /b 1
)

echo [OK] Node.js found
node -v
npm -v
echo.

REM Check database config
echo [*] Checking .env file...
if not exist .env (
    echo [X] .env file not found
    echo [*] Please create .env file and add database credentials
    pause
    exit /b 1
)

echo [OK] .env file found
echo.

REM Check vendor
if not exist vendor (
    echo [*] Installing PHP packages...
    %COMPOSER_CMD% install
    if %errorlevel% neq 0 (
        echo [X] Failed to install PHP packages
        pause
        exit /b 1
    )
)

REM Check node_modules
if not exist node_modules (
    echo [*] Installing JavaScript packages...
    npm install
    if %errorlevel% neq 0 (
        echo [X] Failed to install JavaScript packages
        pause
        exit /b 1
    )
)

REM Check APP_KEY
echo [*] Checking application key...
php artisan key:generate --show >nul 2>&1
if %errorlevel% neq 0 (
    echo [*] Generating application key...
    php artisan key:generate
)

REM Build assets
echo [*] Building assets...
if not exist "public\build" (
    echo [*] Building assets (may take a minute)...
    npm run build
)

echo.
echo ========================================
echo [OK] Everything is ready!
echo ========================================
echo.
echo [*] Starting the application...
echo [*] Open browser at: http://localhost:8000
echo.
echo Press Ctrl+C to stop the server
echo.

php artisan serve

pause

