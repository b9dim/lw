@echo off
chcp 65001 >nul
title Complete Setup - Law Firm Project

echo.
echo ========================================
echo   Complete Project Setup
echo ========================================
echo.

REM Check PHP
where php >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP is not in PATH
    echo Please use CMD or Git Bash instead of PowerShell
    echo Or add PHP to PATH
    pause
    exit /b 1
)

echo [OK] PHP found
echo.

REM Check Composer
set COMPOSER_CMD=
where composer >nul 2>&1
if not errorlevel 1 (
    set COMPOSER_CMD=composer
) else (
    if exist composer.phar (
        set COMPOSER_CMD=php composer.phar
    ) else (
        echo ERROR: Composer not found
        pause
        exit /b 1
    )
)

echo [OK] Composer ready
echo.

REM Check Node.js
where node >nul 2>&1
if errorlevel 1 (
    echo WARNING: Node.js not found in PATH
    echo npm packages will not be installed
    echo Please install Node.js or add it to PATH
    set SKIP_NPM=1
) else (
    echo [OK] Node.js found
    set SKIP_NPM=0
)

echo.

REM Install npm packages
if "%SKIP_NPM%"=="0" (
    if not exist node_modules (
        echo [*] Installing JavaScript packages...
        npm install
        if errorlevel 1 (
            echo WARNING: Failed to install npm packages
            echo You can install them later with: npm install
        ) else (
            echo [OK] JavaScript packages installed
        )
    ) else (
        echo [OK] JavaScript packages already installed
    )
) else (
    echo [SKIP] Skipping npm install (Node.js not found)
)

echo.

REM Generate app key
echo [*] Generating application key...
php artisan key:generate >nul 2>&1
if errorlevel 1 (
    echo WARNING: Failed to generate app key
    echo You can generate it later with: php artisan key:generate
) else (
    echo [OK] Application key generated
)

echo.

REM Check database
echo [*] Checking database configuration...
findstr /C:"DB_DATABASE=law_firm" .env >nul 2>&1
if errorlevel 1 (
    echo WARNING: Database name is not 'law_firm' in .env
    echo Please update .env file
)

echo.
echo [*] Attempting to run migrations...
echo [*] Make sure MySQL is running and database 'law_firm' exists
echo.

REM Try to run migrations
php artisan migrate --seed
if errorlevel 1 (
    echo.
    echo WARNING: Migrations failed
    echo Please:
    echo 1. Make sure MySQL is running
    echo 2. Create database: CREATE DATABASE law_firm;
    echo 3. Check .env file database settings
    echo 4. Run manually: php artisan migrate --seed
    echo.
) else (
    echo [OK] Migrations completed successfully
)

echo.

REM Build assets
if "%SKIP_NPM%"=="0" (
    echo [*] Building assets...
    npm run build
    if errorlevel 1 (
        echo WARNING: Failed to build assets
        echo You can build later with: npm run build
    ) else (
        echo [OK] Assets built successfully
    )
) else (
    echo [SKIP] Skipping asset build (Node.js not found)
)

echo.
echo ========================================
echo   Setup Complete!
echo ========================================
echo.
echo To start the server, run:
echo    php artisan serve
echo.
echo Then open browser:
echo    http://localhost:8000
echo.
echo ========================================
echo.
echo Login credentials:
echo.
echo Admin Panel:
echo   Email: admin@lawfirm.sa
echo   Password: password
echo.
echo Client Portal:
echo   National ID: 1234567890
echo   Case Number: CASE-2024-001
echo.
echo ========================================
echo.

pause

