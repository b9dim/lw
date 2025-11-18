# تثبيت Composer

## الطريقة السريعة

### إذا كنت تستخدم Laragon:
Composer موجود تلقائياً! فقط تأكد من إعادة فتح Terminal بعد تثبيت Laragon.

### إذا كنت تستخدم XAMPP:
1. افتح Command Prompt
2. انتقل إلى مجلد المشروع:
   ```bash
   cd C:\Users\b9di\Desktop\lw
   ```
3. ثبّت Composer محلياً:
   ```bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"
   ```

### التثبيت اليدوي (موصى به):

1. **حمّل Composer:**
   - اذهب إلى: https://getcomposer.org/download/
   - حمّل `Composer-Setup.exe`

2. **ثبّت Composer:**
   - شغّل `Composer-Setup.exe`
   - اختر مسار PHP (عادة `C:\xampp\php\php.exe` أو `C:\laragon\bin\php\...`)
   - اتبع التعليمات

3. **تحقق من التثبيت:**
   ```bash
   composer --version
   ```

---

## بعد التثبيت

شغّل:
```bash
start.bat
```

أو يدوياً:
```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

---

## ملاحظة

إذا كان Composer غير موجود في PATH، استخدم:
```bash
php composer.phar install
```

بدلاً من:
```bash
composer install
```

