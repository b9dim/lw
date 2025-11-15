@echo off
chcp 65001 >nul
echo ========================================
echo   رفع التغييرات على GitHub
echo ========================================
echo.

REM التحقق من وجود Git
where git >nul 2>&1
if %errorlevel% neq 0 (
    echo [X] Git غير مثبت!
    echo [*] قم بتثبيت Git من: https://git-scm.com/download/win
    echo.
    pause
    exit /b 1
)

echo [OK] Git موجود
echo.

REM الانتقال إلى مجلد المشروع
cd /d "%~dp0"

REM التحقق من وجود .git
if not exist .git (
    echo [*] المشروع غير مربوط بـ Git
    echo [*] هل تريد تهيئة Git؟ (Y/N)
    set /p init_git="> "
    if /i "%init_git%"=="Y" (
        echo [*] تهيئة Git...
        git init
        echo [OK] تم تهيئة Git
        echo.
        echo [*] يجب إضافة remote repository:
        echo [*] git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
        echo.
        pause
        exit /b 0
    ) else (
        echo [X] تم الإلغاء
        pause
        exit /b 0
    )
)

REM عرض حالة Git
echo [*] حالة الملفات:
git status
echo.

REM إضافة الملفات
echo [*] إضافة الملفات...
git add .
if %errorlevel% neq 0 (
    echo [X] فشل إضافة الملفات
    pause
    exit /b 1
)
echo [OK] تم إضافة الملفات
echo.

REM إنشاء commit
echo [*] إنشاء commit...
set /p commit_msg="اكتب رسالة commit (أو اضغط Enter للرسالة الافتراضية): "
if "%commit_msg%"=="" (
    set commit_msg=إصلاح خطأ view:clear~ و view:cache - إزالة view:cache من Build Command
)

git commit -m "%commit_msg%"
if %errorlevel% neq 0 (
    echo [X] فشل إنشاء commit
    echo [*] قد لا توجد تغييرات جديدة
    pause
    exit /b 1
)
echo [OK] تم إنشاء commit
echo.

REM رفع التغييرات
echo [*] رفع التغييرات على GitHub...
git push
if %errorlevel% neq 0 (
    echo [X] فشل رفع التغييرات
    echo.
    echo [*] قد تحتاج إلى:
    echo [*] 1. إضافة remote repository:
    echo [*]    git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
    echo [*] 2. أو التحقق من اسم المستخدم وكلمة المرور
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo [OK] تم رفع التغييرات بنجاح!
echo ========================================
echo.
pause

