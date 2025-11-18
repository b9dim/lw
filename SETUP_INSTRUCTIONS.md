# تعليمات تشغيل المشروع

## المتطلبات الأساسية

قبل تشغيل المشروع، تأكد من تثبيت:

1. **PHP 8.2 أو أحدث**
   - تحميل من: https://www.php.net/downloads.php
   - أو استخدام XAMPP/WAMP

2. **Composer**
   - تحميل من: https://getcomposer.org/download/

3. **Node.js & NPM**
   - تحميل من: https://nodejs.org/

4. **MySQL أو MariaDB**
   - تأكد من تشغيل قاعدة البيانات

## خطوات التشغيل

### 1. تثبيت المتطلبات

افتح Terminal/Command Prompt في مجلد المشروع وقم بتنفيذ:

```bash
# تثبيت مكتبات PHP
composer install

# تثبيت مكتبات JavaScript
npm install
```

### 2. إعداد قاعدة البيانات

1. أنشئ قاعدة بيانات جديدة باسم `law_firm` في MySQL
2. افتح ملف `.env` وقم بتعديل إعدادات قاعدة البيانات:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=law_firm
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 3. توليد مفتاح التطبيق

```bash
php artisan key:generate
```

### 4. إنشاء جداول قاعدة البيانات

```bash
php artisan migrate --seed
```

هذا الأمر سينشئ جميع الجداول ويملأها ببيانات تجريبية.

### 5. بناء الأصول (Assets)

للتطوير (مع Hot Reload):
```bash
npm run dev
```

للإنتاج:
```bash
npm run build
```

### 6. تشغيل المشروع

```bash
php artisan serve
```

المشروع سيعمل على: `http://localhost:8000`

## بيانات الدخول الافتراضية

### دخول الإدارة
- **البريد الإلكتروني:** admin@lawfirm.sa
- **كلمة المرور:** password

### دخول العميل
- **رقم الهوية:** 1234567890
- **رقم القضية:** CASE-2024-001

## استكشاف الأخطاء

### خطأ: PHP غير موجود
- تأكد من تثبيت PHP وإضافته إلى PATH
- أو استخدم XAMPP/WAMP

### خطأ: Composer غير موجود
- قم بتحميل Composer من الموقع الرسمي
- أو استخدم `composer.phar` محلياً

### خطأ: قاعدة البيانات
- تأكد من تشغيل MySQL
- تحقق من بيانات الاتصال في ملف `.env`
- تأكد من إنشاء قاعدة البيانات `law_firm`

### خطأ: Port 8000 مستخدم
- استخدم port آخر: `php artisan serve --port=8001`

## ملاحظات

- تأكد من تشغيل `npm run dev` في نافذة منفصلة أثناء التطوير
- جميع الملفات جاهزة والكود مكتمل
- التصميم مستوحى من موقع وزارة العدل السعودية

