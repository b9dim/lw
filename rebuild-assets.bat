@echo off
setlocal enabledelayedexpansion
echo ========================================
echo Rebuilding Assets - Force Clean Build
echo ========================================
echo.

REM Check for Node.js
where node >nul 2>&1
if errorlevel 1 (
    echo Node.js not found in PATH, searching Laragon...
    set NODE_FOUND=0
    set NODE_PATH=
    
    if exist "C:\laragon\bin\nodejs" (
        echo Found Laragon Node.js directory, searching for versions...
        for /d %%d in ("C:\laragon\bin\nodejs\node-v*") do (
            if exist "%%d\npm.cmd" (
                echo Found Node.js: %%d
                set "NODE_PATH=%%d"
                set "NODE_FOUND=1"
            )
        )
    )
    
    if "!NODE_FOUND!"=="0" (
        echo ERROR: Node.js not found!
        echo Please install Node.js in Laragon or globally.
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
echo npm version:
npm -v
echo.

REM Clean old build files
echo Cleaning old build files...
if exist "public\build" (
    del /q "public\build\assets\*.css" 2>nul
    del /q "public\build\assets\*.js" 2>nul
    del /q "public\build\manifest.json" 2>nul
    echo Old build files deleted.
)

echo.
echo Installing packages (if needed)...
if not exist node_modules (
    call npm install
    if errorlevel 1 (
        echo ERROR: Failed to install packages
        pause
        exit /b 1
    )
)

echo.
echo Building assets (this may take a moment)...
call npm run build

if errorlevel 1 (
    echo ERROR: Failed to build assets
    pause
    exit /b 1
)

echo.
echo ========================================
echo Assets rebuilt successfully!
echo ========================================
echo.
echo Please:
echo 1. Refresh your browser with Ctrl+F5 (hard refresh)
echo 2. Or clear browser cache
echo.
pause

