@echo off
setlocal enabledelayedexpansion
echo ========================================
echo Completing Asset Build
echo ========================================
echo.

REM Clean old build files
echo Cleaning old build files...
if exist "public\build\assets\*.css" del /q "public\build\assets\*.css"
if exist "public\build\assets\*.js" del /q "public\build\assets\*.js"
if exist "public\build\manifest.json" del /q "public\build\manifest.json"
echo Old build files deleted.
echo.

REM Build assets
echo Building assets...
call npm run build

if errorlevel 1 (
    echo.
    echo ERROR: Build failed!
    pause
    exit /b 1
)

echo.
echo ========================================
echo Build completed successfully!
echo ========================================
echo.
echo Next steps:
echo 1. Refresh your browser with Ctrl+F5
echo 2. Check if the new design appears
echo.
pause

