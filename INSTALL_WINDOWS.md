# دليل تثبيت المتطلبات على Windows

## الطريقة الأسهل: استخدام XAMPP

### 1. تثبيت XAMPP

1. حمّل XAMPP من: https://www.apachefriends.org/download.html
2. ثبّت XAMPP (يفضل في `C:\xampp`)
3. شغّل XAMPP Control Panel
4. ابدأ Apache و MySQL

### 2. إضافة PHP إلى PATH

بعد تثبيت XAMPP:

1. افتح **System Properties** → **Environment Variables**
2. في **System Variables**، اختر **Path** ثم **Edit**
3. أضف المسار: `C:\xampp\php`
4. أضف أيضاً: `C:\xampp\mysql\bin`
5. اضغط **OK** في جميع النوافذ

### 3. تثبيت Composer

#### الطريقة الأولى: التثبيت التلقائي (موصى به)

1. حمّل Composer-Setup.exe من: https://getcomposer.org/download/
2. شغّل الملف واتبع التعليمات
3. تأكد من اختيار مسار PHP الصحيح (`C:\xampp\php\php.exe`)

#### الطريقة الثانية: التثبيت اليدوي

1. حمّل `composer.phar` من: https://getcomposer.org/download/
2. ضع الملف في `C:\xampp\php\composer.phar`
3. أنشئ ملف `composer.bat` في نفس المجلد:

```batch
@echo off
php "%~dp0composer.phar" %*
```

4. أضف `C:\xampp\php` إلى PATH (إذا لم تكن أضفته)

### 4. التحقق من التثبيت

افتح Command Prompt جديد واكتب:

```bash
php -v
composer --version
```

يجب أن ترى إصدارات PHP و Composer.

---

## الطريقة البديلة: استخدام Laragon (أسهل)

Laragon يتضمن كل شيء جاهز:

1. حمّل Laragon من: https://laragon.org/download/
2. ثبّت Laragon
3. شغّل Laragon
4. كل شيء جاهز! (PHP, MySQL, Composer)

---

## بعد التثبيت

بعد تثبيت PHP و Composer:

1. افتح Command Prompt جديد
2. انتقل إلى مجلد المشروع:
   ```bash
   cd C:\Users\b9di\Desktop\lw
   ```

3. نفّذ الأوامر:
   ```bash
   composer install
   npm install
   ```

---

## تثبيت Node.js

إذا لم يكن Node.js مثبتاً:

1. حمّل من: https://nodejs.org/
2. ثبّت Node.js
3. أعد فتح Command Prompt

---

## ملاحظات

- بعد إضافة PATH، يجب إعادة فتح Command Prompt
- تأكد من تشغيل MySQL قبل تشغيل المشروع
- XAMPP يتضمن Apache, MySQL, PHP - كل ما تحتاجه

