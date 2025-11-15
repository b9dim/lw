# 📊 دليل استيراد قاعدة البيانات الموجودة إلى Render

هذا الدليل يشرح كيفية استيراد قاعدة البيانات المحلية إلى Render.

## 🗄️ الطريقة 1: استخدام mysqldump (موصى به)

### الخطوة 1: تصدير قاعدة البيانات المحلية

```bash
# في Terminal المحلي
mysqldump -u root -p law_firm > law_firm_backup.sql
```

أو إذا كان لديك كلمة مرور:
```bash
mysqldump -u root -pYourPassword law_firm > law_firm_backup.sql
```

### الخطوة 2: استيراد إلى Render Database

#### أ) عبر Render Shell:

1. اذهب إلى Web Service Dashboard
2. اضغط **"Shell"**
3. نفذ:

```bash
# تحميل الملف (انسخ محتوى law_firm_backup.sql)
# ثم استخدم mysql command:

mysql -h YOUR_DB_HOST -u YOUR_DB_USER -p YOUR_DB_NAME < law_firm_backup.sql
```

#### ب) عبر Render CLI:

```bash
# تثبيت Render CLI
npm install -g render-cli

# تسجيل الدخول
render login

# رفع الملف
render exec -s law-firm-db -- mysql -u YOUR_USER -p YOUR_DB < law_firm_backup.sql
```

#### ج) عبر MySQL Client محلي:

```bash
# الاتصال بقاعدة بيانات Render
mysql -h YOUR_DB_HOST.render.com -P 3306 -u YOUR_DB_USER -p

# ثم داخل MySQL:
USE law_firm;
SOURCE law_firm_backup.sql;
```

---

## 🗄️ الطريقة 2: استخدام Laravel Migrations + Seeders

إذا كنت تريد إعادة إنشاء البيانات:

### الخطوة 1: تشغيل Migrations

```bash
# في Render Shell
php artisan migrate --force
```

### الخطوة 2: تشغيل Seeders

```bash
# في Render Shell
php artisan db:seed --force
```

---

## 🗄️ الطريقة 3: استخدام phpMyAdmin أو Adminer

### الخطوة 1: إنشاء Tunnel آمن

```bash
# على جهازك المحلي
ssh -L 3306:YOUR_DB_HOST.render.com:3306 user@render.com
```

### الخطوة 2: الاتصال بـ phpMyAdmin

1. افتح phpMyAdmin محلياً
2. استخدم:
   - Host: `127.0.0.1`
   - Port: `3306`
   - Username: `YOUR_DB_USER`
   - Password: `YOUR_DB_PASSWORD`

### الخطوة 3: استيراد الملف

1. اختر قاعدة البيانات
2. اضغط **"Import"**
3. اختر ملف `.sql`
4. اضغط **"Go"**

---

## 🔐 الحصول على معلومات الاتصال

### من Render Dashboard:

1. اذهب إلى Database Service
2. اضغط **"Connections"**
3. انسخ:
   - **Internal Database URL** (للاستخدام من Render Services)
   - **External Connection String** (للاستخدام من خارج Render)

### مثال على Connection String:

```
mysql://user:password@host:port/database
```

استخرج:
- `user` → DB_USERNAME
- `password` → DB_PASSWORD
- `host` → DB_HOST
- `port` → DB_PORT
- `database` → DB_DATABASE

---

## ⚠️ ملاحظات مهمة

1. **الأمان:**
   - لا تشارك معلومات الاتصال
   - استخدم Environment Variables دائماً

2. **الحجم:**
   - إذا كانت قاعدة البيانات كبيرة (>100MB)، قد تحتاج لخطة مدفوعة

3. **الوقت:**
   - الاستيراد قد يستغرق وقتاً حسب حجم البيانات

4. **النسخ الاحتياطي:**
   - احتفظ بنسخة احتياطية محلية دائماً

---

## 🚀 بعد الاستيراد

1. تحقق من البيانات:
```bash
php artisan tinker
>>> DB::table('users')->count();
>>> DB::table('cases')->count();
```

2. اختبر الموقع:
- افتح الموقع
- جرب تسجيل الدخول
- تحقق من البيانات

---

## 🐛 حل المشاكل

### المشكلة: Connection Refused

**الحل:**
- تحقق من Firewall Rules
- تأكد من استخدام External Connection String

### المشكلة: Access Denied

**الحل:**
- تحقق من Username و Password
- تأكد من أن المستخدم لديه الصلاحيات الكافية

### المشكلة: Database Doesn't Exist

**الحل:**
- أنشئ قاعدة البيانات أولاً:
```sql
CREATE DATABASE law_firm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## ✅ التحقق من النجاح

بعد الاستيراد، تحقق من:

```bash
# عدد المستخدمين
php artisan tinker
>>> \App\Models\User::count();

# عدد القضايا
>>> \App\Models\Case_::count();

# عدد العملاء
>>> \App\Models\Client::count();
```

إذا كانت الأرقام صحيحة، فالإستيراد نجح! 🎉

