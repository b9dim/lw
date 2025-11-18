# 📥 دليل استيراد قاعدة البيانات إلى Render

## ⚠️ ملاحظة مهمة

قاعدة البيانات على Render هي **PostgreSQL**، بينما ملف `law_firm_backup.sql` هو **MySQL dump**. ستحتاج إلى تحويل البيانات أو استخدام Laravel Seeders.

---

## 🎯 الطريقة 1: استخدام Laravel Seeders (موصى به)

هذه الطريقة الأسهل والأكثر أماناً. سننشئ Seeders من البيانات الموجودة.

### الخطوة 1: إنشاء Seeders من البيانات

سأقوم بإنشاء Seeders تحتوي على البيانات من ملف SQL.

### الخطوة 2: تشغيل Migrations والSeeders على Render

في Render Shell:
```bash
cd /var/www/html
php artisan migrate --force
php artisan db:seed --force
```

---

## 🔄 الطريقة 2: تحويل MySQL إلى PostgreSQL

### الخيار أ: استخدام أداة تحويل عبر الإنترنت

1. اذهب إلى: https://www.sqlines.com/online
2. الصق محتوى `law_firm_backup.sql`
3. اختر MySQL → PostgreSQL
4. انسخ النتيجة
5. احفظها في ملف `law_firm_backup_pgsql.sql`

### الخيار ب: استخدام pgloader (أدق)

إذا كان لديك Docker محلي:
```bash
docker run --rm -v /path/to/law_firm_backup.sql:/data.sql dimitri/pgloader \
  mysql://user:password@host/database \
  postgresql://law_firm_db_i2lx_user:OOxzUnrwhbAySqdtIeNTJjWHvO6wwY1E@dpg-d4cd820gjchc73db1m8g-a.oregon-postgres.render.com:5432/law_firm_db_i2lx
```

---

## 🚀 الطريقة 3: استيراد مباشر عبر Render Shell

### الخطوة 1: تحويل الملف يدوياً

الاختلافات الرئيسية بين MySQL و PostgreSQL:
- `AUTO_INCREMENT` → `SERIAL` أو `BIGSERIAL`
- `` `backticks` `` → `"double quotes"`
- `ENGINE=InnoDB` → يُحذف
- `COLLATE utf8mb4_unicode_ci` → `COLLATE "utf8"`
- `enum()` → `CHECK` constraint أو `VARCHAR` مع constraint

### الخطوة 2: رفع الملف إلى Render

1. ارفع الملف المحوّل إلى Render Shell
2. أو استخدم `psql` مباشرة

### الخطوة 3: استيراد البيانات

في Render Shell:
```bash
# الاتصال بقاعدة البيانات
psql postgresql://law_firm_db_i2lx_user:OOxzUnrwhbAySqdtIeNTJjWHvO6wwY1E@dpg-d4cd820gjchc73db1m8g-a.oregon-postgres.render.com:5432/law_firm_db_i2lx

# أو استيراد الملف
psql postgresql://law_firm_db_i2lx_user:OOxzUnrwhbAySqdtIeNTJjWHvO6wwY1E@dpg-d4cd820gjchc73db1m8g-a.oregon-postgres.render.com:5432/law_firm_db_i2lx < law_firm_backup_pgsql.sql
```

---

## 📋 الطريقة 4: استخدام Laravel Tinker (الأسهل)

### الخطوة 1: تشغيل Migrations أولاً

في Render Shell:
```bash
php artisan migrate --force
```

### الخطوة 2: استخدام Tinker لاستيراد البيانات

```bash
php artisan tinker
```

ثم استورد البيانات يدوياً عبر Tinker (سأقوم بإنشاء script لذلك).

---

## ✅ الطريقة الموصى بها: Laravel Seeders

سأقوم بإنشاء Seeders تحتوي على جميع البيانات من ملف SQL. هذه الطريقة:
- ✅ تعمل مع أي نوع قاعدة بيانات
- ✅ آمنة ومضمونة
- ✅ سهلة الصيانة
- ✅ متوافقة مع Laravel

---

## 🔧 الخطوات الفورية

1. **تشغيل Migrations** (إنشاء الجداول):
   ```bash
   php artisan migrate --force
   ```

2. **تشغيل Seeders** (إدخال البيانات):
   ```bash
   php artisan db:seed --force
   ```

---

## 📝 ملاحظات

- تأكد من أن Migrations تعمل قبل استيراد البيانات
- البيانات الحالية في قاعدة البيانات ستُستبدل
- احتفظ بنسخة احتياطية قبل الاستيراد

---

## 🆘 إذا واجهت مشاكل

### خطأ: "relation does not exist"
- تأكد من تشغيل Migrations أولاً

### خطأ: "syntax error"
- الملف قد يحتاج تحويل من MySQL إلى PostgreSQL

### خطأ: "connection refused"
- تحقق من معلومات الاتصال في Environment Variables

