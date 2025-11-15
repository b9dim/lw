@echo off
setlocal enabledelayedexpansion
echo ========================================
echo Building Assets for Law Firm Project (Laragon)
echo ========================================
echo.

REM Check for Node.js in PATH first
where node >nul 2>&1
if errorlevel 1 (
    echo Node.js not found in PATH, searching Laragon...
    
    REM Try to find Laragon Node.js automatically
    set NODE_FOUND=0
    set NODE_PATH=
    
    REM Check if Laragon exists
    if exist "C:\laragon\bin\nodejs" (
        echo Found Laragon Node.js directory, searching for versions...
        
        REM Try to find any node version
        for /d %%d in ("C:\laragon\bin\nodejs\node-v*") do (
            if exist "%%d\npm.cmd" (
                echo Found Node.js: %%d
                set "NODE_PATH=%%d"
                set "NODE_FOUND=1"
            )
        )
    )
    
    if "!NODE_FOUND!"=="0" (
        echo.
        echo ERROR: Node.js not found!
        echo.
        echo Please do one of the following:
        echo 1. Install Node.js in Laragon:
        echo    - Open Laragon
        echo    - Menu ^> Tools ^> Quick add ^> Node.js
        echo.
        echo 2. Or install Node.js globally from: https://nodejs.org/
        echo.
        pause
        exit /b 1
    ) else (
        echo Adding Node.js to PATH: !NODE_PATH!
        set "PATH=!NODE_PATH!;%PATH%"
    )
)

echo.
echo Node.js version:
node -v
echo.
echo npm version:
npm -v
echo.

REM Check if node_modules exists
if not exist node_modules (
    echo Installing JavaScript packages...
    call npm install
    if errorlevel 1 (
        echo ERROR: Failed to install packages
        pause
        exit /b 1
    )
    echo.
)

echo Building assets...
call npm run build

if errorlevel 1 (
    echo ERROR: Failed to build assets
    pause
    exit /b 1
)

echo.
echo ========================================
echo Assets built successfully!
echo ========================================
echo.
echo Please refresh your browser (Ctrl+F5) to see the changes.
echo.
pause

