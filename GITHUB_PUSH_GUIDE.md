# 📤 دليل رفع التغييرات على GitHub

## 🎯 الخطوات السريعة

### 1️⃣ التحقق من تثبيت Git

افتح **Command Prompt** أو **PowerShell** واكتب:
```bash
git --version
```

إذا ظهرت رسالة خطأ، قم بتثبيت Git من: https://git-scm.com/download/win

---

## 📝 خطوات رفع التغييرات

### الطريقة 1: إذا كان المشروع مربوطاً بـ GitHub بالفعل

افتح **Command Prompt** أو **PowerShell** في مجلد المشروع (`C:\Users\b9di\Desktop\lw`) واكتب:

```bash
# 1. التحقق من حالة الملفات
git status

# 2. إضافة جميع الملفات المعدلة
git add .

# 3. إنشاء commit مع رسالة وصفية
git commit -m "إصلاح خطأ view:clear~ و view:cache - إزالة view:cache من Build Command"

# 4. رفع التغييرات على GitHub
git push
```

---

### الطريقة 2: إذا كان المشروع غير مربوط بـ GitHub

#### الخطوة 1: إنشاء Repository على GitHub

1. اذهب إلى [github.com](https://github.com)
2. اضغط على **"+"** (أعلى اليمين) → **"New repository"**
3. املأ:
   - **Repository name:** `law-firm-app` (أو أي اسم تريده)
   - **Description:** (اختياري)
   - **Public** أو **Private** (اختر ما يناسبك)
4. **لا** تضع علامة على "Initialize with README"
5. اضغط **"Create repository"**

#### الخطوة 2: ربط المشروع بـ GitHub

افتح **Command Prompt** أو **PowerShell** في مجلد المشروع واكتب:

```bash
# 1. تهيئة Git (إذا لم يكن مهيأ)
git init

# 2. إضافة جميع الملفات
git add .

# 3. إنشاء أول commit
git commit -m "Initial commit - Laravel Law Firm Application"

# 4. إضافة remote repository (استبدل YOUR_USERNAME و YOUR_REPO_NAME)
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git

# 5. رفع التغييرات
git push -u origin main
```

**ملاحظة:** إذا كان اسم الفرع `master` بدلاً من `main`:
```bash
git push -u origin master
```

---

## 🔐 إذا طُلب منك اسم المستخدم وكلمة المرور

### الطريقة 1: استخدام Personal Access Token

1. اذهب إلى GitHub → **Settings** → **Developer settings** → **Personal access tokens** → **Tokens (classic)**
2. اضغط **"Generate new token"**
3. اختر الصلاحيات: `repo` (كامل)
4. انسخ الـ Token
5. عند الطلب:
   - **Username:** اسم المستخدم على GitHub
   - **Password:** الصق الـ Token (وليس كلمة المرور)

### الطريقة 2: استخدام GitHub Desktop

1. حمّل GitHub Desktop من: https://desktop.github.com
2. سجّل الدخول بحساب GitHub
3. افتح المشروع في GitHub Desktop
4. اضغط **"Commit"** ثم **"Push origin"**

---

## 📋 الأوامر الكاملة (نسخ ولصق)

### إذا كان المشروع مربوطاً:

```bash
cd C:\Users\b9di\Desktop\lw
git add .
git commit -m "إصلاح خطأ view:clear~ و view:cache"
git push
```

### إذا كان المشروع غير مربوط:

```bash
cd C:\Users\b9di\Desktop\lw
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
git branch -M main
git push -u origin main
```

**⚠️ مهم:** استبدل `YOUR_USERNAME` و `YOUR_REPO_NAME` بالقيم الصحيحة!

---

## ✅ التحقق من النجاح

بعد `git push`، اذهب إلى صفحة Repository على GitHub وتحقق من:
- ✅ الملفات المعدلة موجودة
- ✅ رسالة Commit تظهر في History
- ✅ لا توجد أخطاء

---

## 🆘 حل المشاكل الشائعة

### خطأ: "fatal: not a git repository"

**الحل:**
```bash
git init
```

### خطأ: "fatal: remote origin already exists"

**الحل:**
```bash
git remote remove origin
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
```

### خطأ: "failed to push some refs"

**الحل:**
```bash
git pull origin main --allow-unrelated-histories
git push
```

### خطأ: "Authentication failed"

**الحل:** استخدم Personal Access Token بدلاً من كلمة المرور

---

## 💡 نصائح

1. **استخدم رسائل commit واضحة:** اكتب وصفاً مختصراً للتغييرات
2. **Commit بشكل منتظم:** لا تنتظر حتى تتراكم التغييرات الكثيرة
3. **تحقق من `.gitignore`:** تأكد من عدم رفع ملفات حساسة مثل `.env`
4. **استخدم GitHub Desktop:** أسهل للمبتدئين

---

## 📱 استخدام GitHub Desktop (أسهل طريقة)

1. **حمّل:** https://desktop.github.com
2. **سجّل الدخول** بحساب GitHub
3. **File** → **Add Local Repository** → اختر مجلد `C:\Users\b9di\Desktop\lw`
4. في GitHub Desktop:
   - اكتب رسالة commit في المربع السفلي
   - اضغط **"Commit to main"**
   - اضغط **"Push origin"**

---

**جاهز!** بعد رفع التغييرات، سيتم تحديث Repository على GitHub 🚀

