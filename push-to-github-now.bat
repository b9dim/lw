@echo off
echo ========================================
echo رفع التعديلات على GitHub
echo ========================================
echo.

REM التحقق من وجود remote
git remote -v >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ Remote repository موجود
    git remote -v
    echo.
    echo هل تريد رفع التعديلات الآن؟ (Y/N)
    set /p PUSH_NOW=
    if /i "%PUSH_NOW%"=="Y" (
        echo.
        echo 📤 رفع التعديلات...
        git push -u origin main
        if %errorlevel% equ 0 (
            echo.
            echo ✅ تم رفع التعديلات بنجاح!
        ) else (
            echo.
            echo ❌ فشل رفع التعديلات. تحقق من:
            echo   1. رابط المستودع صحيح
            echo   2. لديك صلاحيات للرفع
            echo   3. اتصال الإنترنت يعمل
        )
    )
) else (
    echo ⚠️ Remote repository غير موجود
    echo.
    echo يرجى إدخال رابط المستودع على GitHub:
    echo مثال: https://github.com/YOUR_USERNAME/YOUR_REPO.git
    set /p REPO_URL=
    
    if not "%REPO_URL%"=="" (
        echo.
        echo 🔗 إضافة remote repository...
        git remote add origin %REPO_URL%
        
        if %errorlevel% equ 0 (
            echo ✅ تم إضافة remote بنجاح
            echo.
            echo 📤 رفع التعديلات...
            git push -u origin main
            
            if %errorlevel% equ 0 (
                echo.
                echo ✅ تم رفع التعديلات بنجاح!
            ) else (
                echo.
                echo ❌ فشل رفع التعديلات. قد تحتاج إلى:
                echo   1. التحقق من رابط المستودع
                echo   2. استخدام Personal Access Token بدلاً من كلمة المرور
                echo   3. التحقق من صلاحيات الرفع
            )
        ) else (
            echo ❌ فشل إضافة remote
        )
    ) else (
        echo ❌ لم يتم إدخال رابط المستودع
    )
)

echo.
pause


