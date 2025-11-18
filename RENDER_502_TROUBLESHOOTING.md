# 🔧 دليل حل مشكلة 502 Bad Gateway على Render

## ⚠️ المشكلة:
```
502 Bad Gateway
```

---

## 🔍 الخطوة 1: فحص Logs

1. اذهب إلى **Render Dashboard**
2. افتح **Web Service** (`law-firm-app`)
3. اضغط **"Logs"**
4. ابحث عن:
   - أخطاء باللون الأحمر
   - رسائل "Starting server"
   - رسائل "Database connection"

---

## ✅ الخطوة 2: التحقق من الأسباب الشائعة

### السبب 1: قاعدة البيانات غير متصلة

**التحقق:**
في Render Shell:
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

**الحل:**
- تحقق من Environment Variables (DB_HOST, DB_PORT, إلخ)
- تأكد من أن قاعدة البيانات تعمل

---

### السبب 2: Migrations لم يتم تشغيلها

**التحقق:**
```bash
php artisan migrate:status
```

**الحل:**
```bash
php artisan migrate --force
```

---

### السبب 3: APP_KEY غير موجود

**التحقق:**
في Render Shell:
```bash
php artisan tinker
>>> config('app.key');
```

إذا كان `null`، المشكلة هنا.

**الحل:**
- أضف `APP_KEY` في Environment Variables
- استخدم المفتاح من `RENDER_ENV_VARIABLES.md`

---

### السبب 4: الصلاحيات غير صحيحة

**الحل:**
```bash
chmod -R 755 storage bootstrap/cache
```

---

### السبب 5: Cache قديم

**الحل:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🚀 الحل السريع (جرب هذا أولاً):

في Render Shell، نفّذ:

```bash
# 1. Migrations
php artisan migrate --force

# 2. الصلاحيات
chmod -R 755 storage bootstrap/cache

# 3. مسح Cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 4. إعادة Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. التحقق من الاتصال
php artisan tinker
>>> DB::connection()->getPdo();
>>> exit
```

---

## 🔧 إذا استمرت المشكلة:

### 1. فعّل Debug مؤقتاً:

في Render Dashboard → Environment:
```
APP_DEBUG=true
```

احفظ وأعد Deploy. سترى تفاصيل الخطأ.

### 2. تحقق من Start Command:

في Render Dashboard → Settings → Build & Deploy:
- يجب أن يكون: `php artisan serve --host=0.0.0.0 --port=$PORT`

### 3. تحقق من Dockerfile:

- تأكد من أن `Dockerfile` موجود في GitHub
- تأكد من أن CMD صحيح

---

## 📋 قائمة التحقق:

- [ ] Logs لا تظهر أخطاء واضحة
- [ ] قاعدة البيانات متصلة (اختبر بـ tinker)
- [ ] Migrations تم تشغيلها
- [ ] APP_KEY موجود
- [ ] Environment Variables كاملة
- [ ] الصلاحيات صحيحة
- [ ] Cache محدث

---

## 🆘 إذا لم تحل المشكلة:

1. انسخ **كامل** Logs من Render
2. انسخ رسالة الخطأ الكاملة
3. أرسلها هنا للمساعدة

---

**ابدأ بفحص Logs أولاً!** 🔍

