# تثبيت PHP محمول وتشغيل المشروع

$ErrorActionPreference = "Stop"

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "تثبيت PHP محمول وتشغيل المشروع" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$phpDir = Join-Path $PSScriptRoot "php-portable"
$phpZip = Join-Path $PSScriptRoot "php.zip"
$phpUrl = "https://windows.php.net/downloads/releases/php-8.2.13-Win32-vs16-x64.zip"

# إنشاء مجلد PHP
if (-not (Test-Path $phpDir)) {
    New-Item -ItemType Directory -Path $phpDir | Out-Null
}

# التحقق من وجود PHP
$phpExe = Join-Path $phpDir "php.exe"
if (-not (Test-Path $phpExe)) {
    Write-Host "[*] تنزيل PHP محمول..." -ForegroundColor Yellow
    
    try {
        Invoke-WebRequest -Uri $phpUrl -OutFile $phpZip -UseBasicParsing
        Expand-Archive -Path $phpZip -DestinationPath $phpDir -Force
        Remove-Item $phpZip -ErrorAction SilentlyContinue
        
        # نسخ ملف php.ini
        $phpIni = Join-Path $phpDir "php.ini-development"
        if (Test-Path $phpIni) {
            Copy-Item $phpIni (Join-Path $phpDir "php.ini") -Force
        }
        
        Write-Host "[✓] تم تثبيت PHP محمول" -ForegroundColor Green
    } catch {
        Write-Host "[✗] فشل تنزيل PHP: $_" -ForegroundColor Red
        Write-Host "[*] يرجى تثبيت Laragon أو XAMPP" -ForegroundColor Yellow
        exit 1
    }
} else {
    Write-Host "[✓] PHP محمول موجود" -ForegroundColor Green
}

# استخدام PHP المحمول
$env:Path = "$phpDir;$env:Path"

Write-Host ""
Write-Host "[*] جاري تثبيت Composer محلياً..." -ForegroundColor Yellow

# تثبيت Composer محلياً
if (-not (Test-Path "composer.phar")) {
    try {
        Invoke-WebRequest -Uri "https://getcomposer.org/installer" -OutFile "composer-setup.php" -UseBasicParsing
        & $phpExe composer-setup.php
        Remove-Item composer-setup.php -ErrorAction SilentlyContinue
        
        if (Test-Path "composer.phar") {
            Write-Host "[✓] تم تثبيت Composer" -ForegroundColor Green
        }
    } catch {
        Write-Host "[✗] فشل تثبيت Composer: $_" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "[*] التحقق من Node.js..." -ForegroundColor Yellow

# التحقق من Node.js
$nodeExists = Get-Command node -ErrorAction SilentlyContinue
if (-not $nodeExists) {
    Write-Host "[✗] Node.js غير مثبت" -ForegroundColor Red
    Write-Host "[*] يرجى تثبيته من: https://nodejs.org/" -ForegroundColor Yellow
    Write-Host "[*] أو استخدم Docker: docker-compose up -d" -ForegroundColor Yellow
    exit 1
}

Write-Host "[✓] Node.js موجود" -ForegroundColor Green
Write-Host ""

# تثبيت المتطلبات
Write-Host "[*] تثبيت مكتبات PHP..." -ForegroundColor Yellow
if (Test-Path "composer.phar") {
    & $phpExe composer.phar install --no-interaction
} else {
    composer install --no-interaction
}

Write-Host ""
Write-Host "[*] تثبيت مكتبات JavaScript..." -ForegroundColor Yellow
npm install

Write-Host ""
Write-Host "[*] توليد مفتاح التطبيق..." -ForegroundColor Yellow
& $phpExe artisan key:generate

Write-Host ""
Write-Host "[*] بناء الأصول..." -ForegroundColor Yellow
npm run build

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "[✓] كل شيء جاهز!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "[*] جاري تشغيل المشروع..." -ForegroundColor Yellow
Write-Host "[*] افتح المتصفح على: http://localhost:8000" -ForegroundColor Cyan
Write-Host ""

# تشغيل المشروع
& $phpExe artisan serve

