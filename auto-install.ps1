# سكريبت تثبيت تلقائي باستخدام winget أو choco

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "تثبيت تلقائي للمتطلبات" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# التحقق من صلاحيات الإدارة
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "[!] هذا السكريبت يحتاج صلاحيات إدارية" -ForegroundColor Yellow
    Write-Host "[!] يرجى تشغيل PowerShell كمسؤول" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "انقر بزر الماوس الأيمن على PowerShell واختر 'Run as Administrator'" -ForegroundColor Yellow
    pause
    exit
}

# محاولة استخدام winget
$wingetAvailable = Get-Command winget -ErrorAction SilentlyContinue
if ($wingetAvailable) {
    Write-Host "[*] تم العثور على winget" -ForegroundColor Green
    Write-Host "[*] جاري تثبيت Laragon (يتضمن PHP, MySQL, Composer)..." -ForegroundColor Yellow
    
    try {
        winget install --id Laragon.Laragon -e --accept-package-agreements --accept-source-agreements
        Write-Host "[✓] تم تثبيت Laragon بنجاح!" -ForegroundColor Green
        Write-Host ""
        Write-Host "الخطوات التالية:" -ForegroundColor Cyan
        Write-Host "1. شغّل Laragon من قائمة Start" -ForegroundColor Yellow
        Write-Host "2. انتظر حتى يبدأ Apache و MySQL" -ForegroundColor Yellow
        Write-Host "3. شغّل setup-project.bat" -ForegroundColor Yellow
    } catch {
        Write-Host "[✗] فشل التثبيت: $_" -ForegroundColor Red
    }
} else {
    # محاولة استخدام Chocolatey
    $chocoAvailable = Get-Command choco -ErrorAction SilentlyContinue
    if ($chocoAvailable) {
        Write-Host "[*] تم العثور على Chocolatey" -ForegroundColor Green
        Write-Host "[*] جاري تثبيت المتطلبات..." -ForegroundColor Yellow
        
        try {
            choco install laragon -y
            Write-Host "[✓] تم تثبيت Laragon بنجاح!" -ForegroundColor Green
        } catch {
            Write-Host "[✗] فشل التثبيت: $_" -ForegroundColor Red
        }
    } else {
        Write-Host "[✗] لم يتم العثور على winget أو Chocolatey" -ForegroundColor Red
        Write-Host ""
        Write-Host "الخيارات المتاحة:" -ForegroundColor Yellow
        Write-Host ""
        Write-Host "1. تثبيت Laragon يدوياً:" -ForegroundColor Cyan
        Write-Host "   https://laragon.org/download/" -ForegroundColor White
        Write-Host ""
        Write-Host "2. تثبيت Docker Desktop:" -ForegroundColor Cyan
        Write-Host "   https://www.docker.com/products/docker-desktop/" -ForegroundColor White
        Write-Host ""
        Write-Host "3. تثبيت Chocolatey أولاً:" -ForegroundColor Cyan
        Write-Host "   https://chocolatey.org/install" -ForegroundColor White
        Write-Host "   ثم شغّل هذا السكريبت مرة أخرى" -ForegroundColor Yellow
    }
}

Write-Host ""
pause

