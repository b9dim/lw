# سكريبت تثبيت المتطلبات التلقائي
# يتطلب صلاحيات إدارية

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "تثبيت متطلبات المشروع تلقائياً" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# التحقق من صلاحيات الإدارة
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "[!] هذا السكريبت يحتاج صلاحيات إدارية" -ForegroundColor Yellow
    Write-Host "[!] يرجى تشغيل PowerShell كمسؤول (Run as Administrator)" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "البدائل:" -ForegroundColor Yellow
    Write-Host "1. تثبيت Laragon من: https://laragon.org/download/" -ForegroundColor Green
    Write-Host "2. تثبيت XAMPP من: https://www.apachefriends.org/download.html" -ForegroundColor Green
    Write-Host ""
    pause
    exit
}

Write-Host "[*] جاري فحص المتطلبات..." -ForegroundColor Yellow
Write-Host ""

# فحص PHP
$phpPath = $null
$phpPaths = @(
    "C:\xampp\php\php.exe",
    "C:\laragon\bin\php\php-8.2.0\php.exe",
    "C:\laragon\bin\php\php-8.3.0\php.exe",
    "C:\php\php.exe"
)

foreach ($path in $phpPaths) {
    if (Test-Path $path) {
        $phpPath = $path
        Write-Host "[✓] تم العثور على PHP في: $path" -ForegroundColor Green
        break
    }
}

if (-not $phpPath) {
    Write-Host "[✗] PHP غير مثبت" -ForegroundColor Red
    Write-Host "[*] يوصى بتثبيت Laragon (أسهل) أو XAMPP" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Laragon: https://laragon.org/download/" -ForegroundColor Cyan
    Write-Host "XAMPP: https://www.apachefriends.org/download.html" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "بعد التثبيت، شغّل هذا السكريبت مرة أخرى" -ForegroundColor Yellow
    pause
    exit
}

# فحص Composer
$composerExists = Get-Command composer -ErrorAction SilentlyContinue
if ($composerExists) {
    Write-Host "[✓] Composer مثبت" -ForegroundColor Green
    composer --version
} else {
    Write-Host "[*] جاري تثبيت Composer..." -ForegroundColor Yellow
    
    # استخدام PHP الموجود لتنزيل Composer
    $phpDir = Split-Path -Parent $phpPath
    $composerPhar = Join-Path $phpDir "composer.phar"
    
    try {
        Invoke-WebRequest -Uri "https://getcomposer.org/installer" -OutFile "composer-setup.php" -UseBasicParsing
        & $phpPath composer-setup.php --install-dir=$phpDir --filename=composer.phar
        Remove-Item composer-setup.php -ErrorAction SilentlyContinue
        
        if (Test-Path $composerPhar) {
            Write-Host "[✓] تم تثبيت Composer بنجاح" -ForegroundColor Green
            
            # إضافة إلى PATH
            $env:Path += ";$phpDir"
            [Environment]::SetEnvironmentVariable("Path", $env:Path, [EnvironmentVariableTarget]::Machine)
            Write-Host "[✓] تم إضافة Composer إلى PATH" -ForegroundColor Green
        }
    } catch {
        Write-Host "[✗] فشل تثبيت Composer: $_" -ForegroundColor Red
        Write-Host "[*] يرجى تثبيته يدوياً من: https://getcomposer.org/download/" -ForegroundColor Yellow
    }
}

Write-Host ""

# فحص Node.js
$nodeExists = Get-Command node -ErrorAction SilentlyContinue
if ($nodeExists) {
    Write-Host "[✓] Node.js مثبت" -ForegroundColor Green
    node -v
    npm -v
} else {
    Write-Host "[✗] Node.js غير مثبت" -ForegroundColor Red
    Write-Host "[*] يرجى تثبيته من: https://nodejs.org/" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "الخطوات التالية:" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. أعد فتح Command Prompt أو PowerShell" -ForegroundColor Yellow
Write-Host "2. انتقل إلى مجلد المشروع:" -ForegroundColor Yellow
Write-Host "   cd C:\Users\b9di\Desktop\lw" -ForegroundColor White
Write-Host "3. نفّذ:" -ForegroundColor Yellow
Write-Host "   composer install" -ForegroundColor White
Write-Host "   npm install" -ForegroundColor White
Write-Host ""

pause

