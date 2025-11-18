# إعداد Google reCAPTCHA

## الخطوات المطلوبة:

### 1. الحصول على مفاتيح reCAPTCHA

1. اذهب إلى [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. اضغط على **"+"** لإضافة موقع جديد
3. اختر **reCAPTCHA v2** → **"I'm not a robot" Checkbox**
4. أدخل اسم الموقع (مثلاً: Law Firm Website)
5. أدخل النطاق (Domain) - مثلاً: `yourdomain.com` أو `localhost` للتطوير
6. اضغط **Submit**
7. انسخ **Site Key** و **Secret Key**

### 2. إضافة المفاتيح إلى ملف .env

أضف السطور التالية إلى ملف `.env`:

```env
RECAPTCHA_SITE_KEY=your_site_key_here
RECAPTCHA_SECRET_KEY=your_secret_key_here
```

### 3. ملاحظات مهمة:

- **للتطوير المحلي**: يمكنك استخدام `localhost` كـ Domain
- **للإنتاج**: يجب إضافة النطاق الفعلي للموقع
- **اختبار بدون CAPTCHA**: إذا تركت المفاتيح فارغة، سيتم تعطيل التحقق من CAPTCHA (للتطوير فقط)

### 4. التحقق من الإعداد:

بعد إضافة المفاتيح:
1. امسح الكاش: `php artisan config:clear`
2. افتح صفحة "اتصل بنا"
3. يجب أن ترى مربع reCAPTCHA في النموذج
4. جرب إرسال رسالة بدون تحديد reCAPTCHA - يجب أن تظهر رسالة خطأ
5. جرب إرسال رسالة بعد تحديد reCAPTCHA - يجب أن تعمل بشكل صحيح

---

## استكشاف الأخطاء:

### المشكلة: لا يظهر مربع reCAPTCHA
- تأكد من إضافة `RECAPTCHA_SITE_KEY` في ملف `.env`
- تأكد من تشغيل `php artisan config:clear`
- تحقق من أن النطاق في Google reCAPTCHA يتطابق مع نطاق موقعك

### المشكلة: فشل التحقق من reCAPTCHA
- تأكد من إضافة `RECAPTCHA_SECRET_KEY` في ملف `.env`
- تأكد من أن المفاتيح صحيحة
- تحقق من أن النطاق في Google reCAPTCHA يتطابق مع نطاق موقعك

