# 🔐 Environment Variables لـ Render

## 📋 قائمة المتغيرات البيئية المطلوبة

انسخ والصق هذه المتغيرات في **Render Dashboard → Web Service → Environment**:

---

## 🎯 متغيرات التطبيق الأساسية:

```
APP_NAME=شركة مسفر محمد العرجاني للمحاماة
APP_ENV=production
APP_DEBUG=false
APP_URL=https://law-firm-app.onrender.com
APP_TIMEZONE=Asia/Riyadh
APP_LOCALE=ar
APP_FALLBACK_LOCALE=ar
APP_FAKER_LOCALE=ar_SA
```

---

## 🔑 APP_KEY (مهم جداً):

**يجب توليده أولاً:**

```bash
# في Terminal المحلي
php artisan key:generate --show
```

انسخ المفتاح وأضفه:
```
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
```

---

## 🗄️ متغيرات قاعدة البيانات (PostgreSQL):

```
DB_CONNECTION=pgsql
DB_HOST=dpg-d4cd820gjchc73db1m8g-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=law_firm_db_i2lx
DB_USERNAME=law_firm_db_i2lx_user
DB_PASSWORD=OOxzUnrwhbAySqdtIeNTJjWHvO6wwY1E
```

---

## 💾 Session & Cache:

```
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
```

---

## 📝 Logging:

```
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

---

## 📧 Mail:

```
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@lawfirm.sa
MAIL_FROM_NAME=شركة مسفر محمد العرجاني للمحاماة
```

---

## ✅ القائمة الكاملة (للنسخ السريع):

```
APP_NAME=شركة مسفر محمد العرجاني للمحاماة
APP_ENV=production
APP_DEBUG=false
APP_URL=https://law-firm-app.onrender.com
APP_TIMEZONE=Asia/Riyadh
APP_LOCALE=ar
APP_FALLBACK_LOCALE=ar
APP_FAKER_LOCALE=ar_SA
APP_KEY=base64:YOUR_KEY_HERE
DB_CONNECTION=pgsql
DB_HOST=dpg-d4cd820gjchc73db1m8g-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=law_firm_db_i2lx
DB_USERNAME=law_firm_db_i2lx_user
DB_PASSWORD=OOxzUnrwhbAySqdtIeNTJjWHvO6wwY1E
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stderr
LOG_LEVEL=error
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@lawfirm.sa
MAIL_FROM_NAME=شركة مسفر محمد العرجاني للمحاماة
```

---

## 📍 كيفية إضافة المتغيرات في Render:

1. اذهب إلى **Render Dashboard**
2. افتح **Web Service** (`law-firm-app`)
3. اضغط على **"Environment"** (في القائمة الجانبية)
4. اضغط **"Add Environment Variable"**
5. أضف كل متغير واحد تلو الآخر:
   - **Key:** `APP_NAME`
   - **Value:** `شركة مسفر محمد العرجاني للمحاماة`
6. كرر لكل متغير

---

## ⚠️ ملاحظات مهمة:

1. **APP_KEY:** يجب توليده أولاً (لا تنسه!)
2. **APP_URL:** سيتم تحديثه تلقائياً بعد النشر، أو استبدله بـ URL الفعلي
3. **DB_PASSWORD:** حساس - لا تشاركه أبداً
4. **APP_DEBUG:** يجب أن يكون `false` في Production

---

## 🔄 بعد إضافة المتغيرات:

1. احفظ التغييرات
2. اضغط **"Manual Deploy"** → **"Deploy latest commit"**
3. انتظر حتى يكتمل البناء

---

## ✅ التحقق:

بعد Deploy، تحقق من Logs:
- يجب أن ترى: "Database connection successful"
- يجب أن لا ترى أخطاء Database

---

**جاهز!** أضف المتغيرات في Render Dashboard 🚀

