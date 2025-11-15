# 🚀 دليل النشر على Render

هذا الدليل يشرح كيفية نشر مشروع شركة مسفر محمد العرجاني للمحاماة على Render خطوة بخطوة.

## 📋 المتطلبات الأساسية

1. حساب على [Render.com](https://render.com) (مجاني)
2. GitHub repository للمشروع
3. قاعدة بيانات MySQL موجودة (أو سننشئ واحدة جديدة)

---

## 🔧 الخطوة 1: إعداد المشروع على GitHub

### 1.1 إنشاء Repository جديد

```bash
# تأكد أنك في مجلد المشروع
cd C:\Users\b9di\Desktop\lw

# تهيئة Git (إذا لم يكن موجوداً)
git init

# إضافة جميع الملفات
git add .

# عمل Commit
git commit -m "Initial commit - Ready for Render deployment"

# إضافة Remote Repository (استبدل YOUR_USERNAME و YOUR_REPO)
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git

# رفع الملفات
git push -u origin main
```

---

## 🌐 الخطوة 2: إنشاء قاعدة البيانات على Render

### 2.1 تسجيل الدخول إلى Render

1. اذهب إلى [dashboard.render.com](https://dashboard.render.com)
2. سجل الدخول أو أنشئ حساب جديد

### 2.2 إنشاء قاعدة بيانات MySQL

1. اضغط على **"New +"** في Dashboard
2. اختر **"PostgreSQL"** أو **"MySQL"** (MySQL متوفر في الخطط المدفوعة)
3. أو استخدم **"PostgreSQL"** (مجاني) وتعديل إعدادات Laravel

**للحصول على MySQL مجاناً:**
- يمكنك استخدام [PlanetScale](https://planetscale.com) (MySQL مجاني)
- أو [Railway](https://railway.app) (MySQL مجاني)
- أو [Aiven](https://aiven.io) (MySQL مجاني)

**أو استخدام PostgreSQL (مجاني على Render):**

إذا اخترت PostgreSQL، ستحتاج لتعديل `config/database.php`:

```php
'default' => env('DB_CONNECTION', 'pgsql'),
```

---

## 🖥️ الخطوة 3: إنشاء Web Service على Render

### 3.1 إنشاء Service جديد

1. في Dashboard، اضغط **"New +"**
2. اختر **"Web Service"**
3. اختر **"Build from a Git repository"**
4. اربط حساب GitHub الخاص بك
5. اختر Repository المشروع

### 3.2 إعدادات الخدمة

**Basic Settings:**
- **Name:** `law-firm-app`
- **Region:** اختر الأقرب (Frankfurt, Singapore, etc.)
- **Branch:** `main`
- **Root Directory:** (اتركه فارغاً)

**Build & Deploy:**
- **Runtime:** `PHP`
- **Build Command:** 
```bash
composer install --no-dev --optimize-autoloader && npm ci && npm run build && php artisan config:cache && php artisan route:cache && php artisan storage:link
```

**⚠️ ملاحظة:** تم إزالة `view:cache` لأنه يسبب خطأ "View path not found" في بعض الحالات.

- **Start Command:**
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 3.3 إعداد Environment Variables

اضغط على **"Environment"** وأضف المتغيرات التالية:

#### متغيرات التطبيق الأساسية:
```
APP_NAME=شركة مسفر محمد العرجاني للمحاماة
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
APP_TIMEZONE=Asia/Riyadh
APP_LOCALE=ar
APP_FALLBACK_LOCALE=ar
```

#### متغيرات قاعدة البيانات:
```
DB_CONNECTION=mysql
DB_HOST=your-db-host.render.com
DB_PORT=3306
DB_DATABASE=law_firm
DB_USERNAME=your-db-username
DB_PASSWORD=your-db-password
```

#### متغيرات أخرى:
```
LOG_CHANNEL=stderr
LOG_LEVEL=error
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
MAIL_MAILER=log
```

#### توليد APP_KEY:
```bash
# في Terminal المحلي
php artisan key:generate --show
```
انسخ المفتاح وأضفه:
```
APP_KEY=base64:your-generated-key-here
```

---

## 🗄️ الخطوة 4: ربط قاعدة البيانات

### 4.1 إذا استخدمت Render Database:

1. اذهب إلى Database Dashboard
2. انسخ **Internal Database URL** أو **Connection String**
3. استخرج المعلومات:
   - `DB_HOST`
   - `DB_PORT`
   - `DB_DATABASE`
   - `DB_USERNAME`
   - `DB_PASSWORD`

### 4.2 إذا استخدمت قاعدة بيانات خارجية:

أضف معلومات الاتصال في Environment Variables.

---

## 🚀 الخطوة 5: تشغيل Migrations

### 5.1 طريقة 1: عبر Render Shell

1. في Web Service Dashboard، اضغط **"Shell"**
2. نفذ الأوامر التالية:

```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5.2 طريقة 2: عبر Render CLI

```bash
# تثبيت Render CLI
npm install -g render-cli

# تسجيل الدخول
render login

# تشغيل Migrations
render exec -s law-firm-app -- php artisan migrate --force
```

---

## ✅ الخطوة 6: التحقق من النشر

1. انتظر حتى يكتمل البناء (Build)
2. اضغط على **"Visit Site"** أو افتح الرابط
3. تأكد من أن الموقع يعمل بشكل صحيح

---

## 🔄 الخطوة 7: إعداد Auto-Deploy

Render يقوم بـ Auto-Deploy تلقائياً عند:
- Push جديد إلى Branch الرئيسي
- Merge Pull Request

يمكنك تعطيله من **Settings > Auto-Deploy**.

---

## 📝 ملاحظات مهمة

### 1. Storage Files

Render لا يحفظ الملفات بعد إعادة التشغيل. استخدم:
- **AWS S3** للتخزين الدائم
- **Cloudinary** للصور
- أو **Database** للبيانات الصغيرة

### 2. Queue Jobs

إذا كنت تستخدم Queue، ستحتاج إلى:
- إنشاء **Background Worker** على Render
- أو استخدام **Redis** (متوفر في Render)

### 3. Scheduled Tasks

لـ Cron Jobs، استخدم:
- **Render Cron Jobs**
- أو **External Cron Service** مثل [cron-job.org](https://cron-job.org)

### 4. SSL Certificate

Render يوفر SSL تلقائياً لجميع الخدمات.

---

## 🐛 حل المشاكل الشائعة

### المشكلة: Build Fails

**الحل:**
- تأكد من أن `composer.json` و `package.json` موجودان
- تحقق من Build Logs
- تأكد من أن جميع المتغيرات البيئية موجودة

### المشكلة: Database Connection Error

**الحل:**
- تحقق من `DB_HOST` و `DB_PORT`
- تأكد من أن Database Service يعمل
- تحقق من Firewall Rules

### المشكلة: 500 Error

**الحل:**
- تحقق من Logs في Render Dashboard
- تأكد من `APP_DEBUG=false` في Production
- تحقق من `storage/` permissions

### المشكلة: Assets لا تظهر

**الحل:**
- تأكد من تشغيل `npm run build`
- تحقق من `public/build/` موجود
- تأكد من `APP_URL` صحيح

---

## 📞 الدعم

إذا واجهت مشاكل:
1. تحقق من [Render Docs](https://render.com/docs)
2. راجع Logs في Dashboard
3. تحقق من [Laravel Docs](https://laravel.com/docs)

---

## 🎉 تهانينا!

بعد اكتمال النشر، سيكون موقعك متاحاً على:
`https://your-app-name.onrender.com`

**لا تنسى:**
- تحديث `APP_URL` في Environment Variables
- تشغيل Migrations
- إنشاء مستخدم Admin جديد (إذا لزم الأمر)

