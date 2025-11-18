@echo off
echo ========================================
echo Building Assets using Docker
echo ========================================
echo.

echo Checking if Docker container is running...
docker ps | findstr "law_firm_app" >nul
if errorlevel 1 (
    echo ERROR: Docker container 'law_firm_app' is not running
    echo.
    echo Please start Docker containers first:
    echo   docker-compose up -d
    echo.
    pause
    exit /b 1
)

echo Docker container found!
echo.
echo Installing npm packages (if needed)...
docker exec law_firm_app npm install

echo.
echo Building assets...
docker exec law_firm_app npm run build

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

