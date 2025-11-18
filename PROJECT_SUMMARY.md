# ملخص المشروع - شركة مسفر محمد العرجاني للمحاماة

## نظرة عامة
تم بناء نظام إدارة شامل للمحاماة يتضمن:
1. موقع عام (Public Website)
2. لوحة تحكم العملاء (Client Portal)
3. لوحة التحكم الإدارية (Admin Panel)

## البنية التقنية

### Backend
- **Framework:** Laravel 11
- **Authentication:** Laravel Breeze (customized)
- **Database:** MySQL/MariaDB
- **Templates:** Blade Templates

### Frontend
- **CSS Framework:** Tailwind CSS
- **Design:** مستوحى من موقع وزارة العدل السعودية
- **Direction:** RTL كامل للعربية
- **Colors:** أخضر وزارة العدل + أبيض + رمادي

## الملفات الرئيسية

### Models
- `app/Models/User.php` - المستخدمون (مدير، محامي، موظف استقبال)
- `app/Models/Client.php` - العملاء
- `app/Models/Case_.php` - القضايا
- `app/Models/CaseUpdate.php` - تحديثات القضايا
- `app/Models/Inquiry.php` - الاستفسارات

### Controllers
- `app/Http/Controllers/HomeController.php` - الموقع العام
- `app/Http/Controllers/Auth/ClientAuthController.php` - تسجيل دخول العملاء
- `app/Http/Controllers/Client/DashboardController.php` - لوحة تحكم العميل
- `app/Http/Controllers/Admin/*` - لوحة التحكم الإدارية

### Views
- `resources/views/layouts/public.blade.php` - Layout الموقع العام
- `resources/views/layouts/admin.blade.php` - Layout لوحة التحكم
- `resources/views/layouts/client.blade.php` - Layout لوحة العميل
- `resources/views/public/*` - صفحات الموقع العام
- `resources/views/client/*` - صفحات لوحة العميل
- `resources/views/admin/*` - صفحات لوحة التحكم

### Database Migrations
- `database/migrations/2024_01_01_000001_create_users_table.php`
- `database/migrations/2024_01_01_000002_create_clients_table.php`
- `database/migrations/2024_01_01_000003_create_cases_table.php`
- `database/migrations/2024_01_01_000004_create_case_updates_table.php`
- `database/migrations/2024_01_01_000005_create_inquiries_table.php`

### Seeders
- `database/seeders/DatabaseSeeder.php`
- `database/seeders/UserSeeder.php`
- `database/seeders/ClientSeeder.php`
- `database/seeders/CaseSeeder.php`

## المميزات

### الموقع العام
- ✅ الصفحة الرئيسية مع Hero Section
- ✅ صفحة من نحن
- ✅ صفحة الخدمات
- ✅ صفحة اتصل بنا
- ✅ صفحة دخول العملاء

### لوحة تحكم العميل
- ✅ عرض القضايا
- ✅ متابعة التحديثات (Timeline)
- ✅ إرسال الاستفسارات
- ✅ عرض الردود

### لوحة التحكم الإدارية
- ✅ Dashboard مع إحصائيات
- ✅ إدارة العملاء (CRUD)
- ✅ إدارة القضايا (CRUD)
- ✅ إضافة تحديثات للقضايا
- ✅ إدارة الاستفسارات والرد عليها
- ✅ إدارة المستخدمين (CRUD)
- ✅ نظام الصلاحيات (مدير، محامي، موظف استقبال)

## التصميم

### الألوان
- الأخضر: `#2a7a47` (moj-green-600)
- الأخضر الفاتح: `#389458` (moj-green-500)
- الأخضر الداكن: `#1f4e31` (moj-green-900)
- الرمادي: `#6b7280`
- الأبيض: `#ffffff`

### الخطوط
- Cairo (Google Fonts)
- Tajawal (Google Fonts)

### المكونات
- Cards مع shadows ناعمة
- Buttons مع gradients
- Tables احترافية
- Timeline للتحديثات
- Badges للحالات

## الأمان
- ✅ تشفير كلمات المرور (bcrypt)
- ✅ حماية CSRF
- ✅ Middleware للصلاحيات
- ✅ منع الوصول غير المصرح به
- ✅ التحقق من البيانات (Validation)

## بيانات الدخول الافتراضية

### الإدارة
- Email: `admin@lawfirm.sa`
- Password: `password`

### العميل
- رقم الهوية: `1234567890`
- رقم القضية: `CASE-2024-001`

## خطوات التشغيل

1. `composer install`
2. `npm install`
3. نسخ `.env.example` إلى `.env`
4. تعديل إعدادات قاعدة البيانات في `.env`
5. `php artisan key:generate`
6. `php artisan migrate --seed`
7. `npm run build` أو `npm run dev`
8. `php artisan serve`

## ملاحظات
- التصميم مستوحى من موقع وزارة العدل السعودية
- جميع النصوص بالعربية مع دعم RTL كامل
- التصميم متجاوب ويعمل على جميع الأجهزة
- الكود منظم ويتبع أفضل الممارسات

