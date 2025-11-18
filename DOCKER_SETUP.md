# تشغيل المشروع باستخدام Docker

هذه الطريقة **لا تحتاج** تثبيت PHP أو Composer على جهازك!

## المتطلبات

فقط Docker Desktop:
- حمّل من: https://www.docker.com/products/docker-desktop/
- ثبّت Docker Desktop
- شغّل Docker Desktop

## خطوات التشغيل

### 1. تشغيل المشروع

```bash
docker-compose up -d
```

### 2. إعداد Laravel

```bash
# توليد مفتاح التطبيق
docker-compose exec app php artisan key:generate

# إنشاء قاعدة البيانات
docker-compose exec app php artisan migrate --seed

# بناء الأصول
docker-compose exec app npm run build
```

### 3. الوصول للمشروع

افتح المتصفح على: **http://localhost:8000**

## الأوامر المفيدة

```bash
# إيقاف المشروع
docker-compose down

# إعادة تشغيل
docker-compose restart

# عرض السجلات
docker-compose logs -f

# تنفيذ أوامر Laravel
docker-compose exec app php artisan [command]

# تنفيذ Composer
docker-compose exec app composer [command]

# تنفيذ NPM
docker-compose exec app npm [command]
```

## بيانات الدخول

### لوحة الإدارة
- البريد: `admin@lawfirm.sa`
- كلمة المرور: `password`

### لوحة العميل
- رقم الهوية: `1234567890`
- رقم القضية: `CASE-2024-001`

## ملاحظات

- قاعدة البيانات متاحة على: `localhost:3306`
- اسم قاعدة البيانات: `law_firm`
- اسم المستخدم: `root`
- كلمة المرور: `root`

---

## الطريقة التقليدية (بدون Docker)

إذا كنت تفضل تثبيت PHP و Composer:

1. ثبّت **Laragon** من: https://laragon.org/download/
2. شغّل `setup-project.bat`
3. اتبع التعليمات

