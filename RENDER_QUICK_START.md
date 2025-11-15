# ⚡ دليل البدء السريع - Render Deployment

## 🎯 الخطوات السريعة (5 دقائق)

### 1️⃣ رفع المشروع إلى GitHub

```bash
git init
git add .
git commit -m "Ready for Render"
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main
```

### 2️⃣ إنشاء قاعدة بيانات على Render

1. اذهب إلى [dashboard.render.com](https://dashboard.render.com)
2. **New +** → **PostgreSQL** (أو MySQL إذا متوفر)
3. اسم: `law-firm-db`
4. انسخ معلومات الاتصال

### 3️⃣ إنشاء Web Service

1. **New +** → **Web Service**
2. اختر Repository من GitHub
3. الإعدادات:

**Build Command:**
```bash
composer install --no-dev --optimize-autoloader && npm ci && npm run build && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan storage:link
```

**Start Command:**
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 4️⃣ إضافة Environment Variables

في Web Service → Environment:

```
APP_NAME=شركة مسفر محمد العرجاني للمحاماة
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.onrender.com
APP_KEY=base64:YOUR_KEY_HERE
DB_CONNECTION=mysql
DB_HOST=YOUR_DB_HOST
DB_PORT=3306
DB_DATABASE=law_firm
DB_USERNAME=YOUR_DB_USER
DB_PASSWORD=YOUR_DB_PASSWORD
SESSION_DRIVER=database
CACHE_STORE=database
LOG_CHANNEL=stderr
```

### 5️⃣ تشغيل Migrations

في Render Shell:
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 6️⃣ استيراد قاعدة البيانات (اختياري)

إذا كان لديك بيانات موجودة:
```bash
# تصدير من المحلي
mysqldump -u root -p law_firm > backup.sql

# استيراد في Render Shell
mysql -h DB_HOST -u DB_USER -p law_firm < backup.sql
```

---

## ✅ التحقق من النشر

1. ✅ Build نجح
2. ✅ الموقع يفتح
3. ✅ تسجيل الدخول يعمل
4. ✅ البيانات موجودة

---

## 🔗 روابط مفيدة

- [Render Dashboard](https://dashboard.render.com)
- [Render Docs](https://render.com/docs)
- [Laravel Deployment](https://laravel.com/docs/deployment)

---

## 🆘 مساعدة سريعة

**Build فشل؟**
- تحقق من Build Logs
- تأكد من وجود `composer.json` و `package.json`

**Database Error؟**
- تحقق من Environment Variables
- تأكد من أن Database Service يعمل

**500 Error؟**
- تحقق من Logs
- تأكد من `APP_DEBUG=false`
- تحقق من `storage/` permissions

---

## 📝 ملاحظات

- Render يوفر SSL تلقائياً
- الخدمات المجانية قد تنام بعد 15 دقيقة عدم استخدام
- استخدم خطط مدفوعة للإنتاج الحقيقي

