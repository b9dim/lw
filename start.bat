@echo off
echo ========================================
echo Starting Law Firm Project
echo ========================================
echo.

where php >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP is not installed
    echo.
    echo Please install one of:
    echo 1. Laragon: https://laragon.org/download/
    echo 2. XAMPP: https://www.apachefriends.org/download.html
    echo 3. Docker: https://www.docker.com/products/docker-desktop/
    echo.
    pause
    exit /b 1
)

echo PHP found
php -v
echo.

REM Check for Composer
set COMPOSER_CMD=
where composer >nul 2>&1
if not errorlevel 1 (
    set COMPOSER_CMD=composer
    echo Composer found in PATH
) else (
    if exist composer.phar (
        set COMPOSER_CMD=php composer.phar
        echo Using local composer.phar
    ) else (
        echo Composer not found, installing locally...
        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        php composer-setup.php
        php -r "unlink('composer-setup.php');"
        if exist composer.phar (
            set COMPOSER_CMD=php composer.phar
            echo Composer installed successfully
        ) else (
            echo ERROR: Failed to install Composer
            echo Please install Composer manually from: https://getcomposer.org/download/
            pause
            exit /b 1
        )
    )
)

echo.

where node >nul 2>&1
if errorlevel 1 (
    echo ERROR: Node.js is not installed
    echo Please install from: https://nodejs.org/
    pause
    exit /b 1
)

echo Node.js found
echo.

if not exist .env (
    echo ERROR: .env file not found
    pause
    exit /b 1
)

if not exist vendor (
    echo Installing PHP packages...
    %COMPOSER_CMD% install --no-interaction
    if errorlevel 1 (
        echo ERROR: Failed to install PHP packages
        pause
        exit /b 1
    )
)

if not exist node_modules (
    echo Installing JavaScript packages...
    npm install
)

echo.
echo ========================================
echo Starting server...
echo Open: http://localhost:8000
echo Press Ctrl+C to stop
echo ========================================
echo.

php artisan serve

pause

