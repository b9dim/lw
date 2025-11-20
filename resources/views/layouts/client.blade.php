<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة العميل') - شركة مسفر محمد العرجاني</title>
    @include('components.vite-assets', ['assets' => ['resources/css/app.css', 'resources/js/app.js']])
    <!-- SVG Gold Gradient Definition -->
    <svg width="0" height="0" style="position: absolute;">
        <defs>
            <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#FFD700;stop-opacity:1" />
                <stop offset="50%" style="stop-color:#C8A848;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#A0842F;stop-opacity:1" />
            </linearGradient>
        </defs>
    </svg>
</head>
<body class="bg-ink-900 text-ivory-50">
    <!-- Header -->
    <header class="header-client shadow-lg">
        <nav class="container flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="logo flex items-center gap-3">
                <div class="logo-gold">
                    <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة" class="h-10 w-auto">
                </div>
                <div class="leading-tight">
                    <p class="text-xs uppercase tracking-[0.3em] text-brass-400">Client Portal</p>
                    <p class="text-white text-lg font-bold">شركة مسفر محمد العرجاني</p>
                    <p class="text-ivory-200/70 text-xs">للمحاماة والاستشارات القانونية</p>
                </div>
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ route('client.dashboard') }}" class="btn-attorney-secondary">جميع قضاياي</a>
                <form method="POST" action="{{ force_https_route('client.logout') }}">
                    @csrf
                    <button type="submit" class="btn-attorney-primary">تسجيل الخروج</button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-client-content section-shell">
        <div class="container space-y-6">
            @if(session('success'))
                <div id="client-success" class="notification-success animate-fade-up">
                    <div>
                        <p class="notification-title">{{ session('success') }}</p>
                    </div>
                    <button onclick="closeNotification('client-success')" class="notification-close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div id="client-error" class="notification-error animate-fade-up">
                    <div>
                        <p class="notification-title">{{ session('error') }}</p>
                    </div>
                    <button onclick="closeNotification('client-error')" class="notification-close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="surface-card">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-attorney mt-16">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="logo-gold">
                            <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة" class="h-10 w-auto">
                        </div>
                        <h3>شركة مسفر محمد العرجاني</h3>
                    </div>
                    <p>نرافق عملاءنا بخبرات قانونية دقيقة لضمان طمأنينتهم في كل مرحلة.</p>
                    <div class="glass-panel space-y-1">
                        <p class="font-semibold text-ivory-50">خدمة دعم العملاء</p>
                        <a href="tel:+966111234567" class="text-brass-400 text-lg font-bold">+966 11 123 4567</a>
                    </div>
                </div>
                <div>
                    <h3>روابط المنصة</h3>
                    <ul>
                        <li><a href="{{ route('client.dashboard') }}">لوحة العميل</a></li>
                        <li><a href="{{ route('home') }}">الموقع العام</a></li>
                        <li><a href="{{ route('services') }}">الخدمات</a></li>
                        <li><a href="{{ route('contact') }}">الدعم القانوني</a></li>
                    </ul>
                </div>
                <div>
                    <h3>إرشادات مهمة</h3>
                    <ul>
                        <li>تحديث بيانات القضية</li>
                        <li>رفع المستندات</li>
                        <li>مواعيد الجلسات</li>
                        <li>التقييمات والملاحظات</li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <h3>معلومات الاتصال</h3>
                    <p>
                        <strong>البريد الإلكتروني:</strong><br>
                        <a href="mailto:info@lawfirm.sa">info@lawfirm.sa</a>
                    </p>
                    <p>
                        <strong>الهاتف:</strong><br>
                        <a href="tel:+966111234567">+966 11 123 4567</a>
                    </p>
                    <p>
                        <strong>العنوان:</strong><br>
                        الرياض، المملكة العربية السعودية
                    </p>
                </div>
            </div>
            <div class="border-t border-white/15 pt-6 text-center text-sm text-white/70">
                <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية</p>
            </div>
        </div>
    </footer>

    <script>
        function closeNotification(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.style.opacity = '0';
            el.style.transform = 'translateY(-10px)';
            setTimeout(() => el.style.display = 'none', 250);
        }
    </script>
</body>
</html>

