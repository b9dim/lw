<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية')</title>
    @include('components.vite-assets', ['assets' => ['resources/css/app.css', 'resources/js/app.js']])
    <!-- SVG Gold Gradient Definition -->
    <svg width="0" height="0" style="position: absolute;">
        <defs>
            <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#FFD700;stop-opacity:1" />
                <stop offset="50%" style="stop-color:#C8A848;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#A0842F;stop-opacity:1" />
            </linearGradient>
            <filter id="gold-gradient">
                <feColorMatrix type="matrix" values="
                    0.5 0.3 0.0 0 0
                    0.4 0.3 0.0 0 0
                    0.0 0.0 0.0 0 0
                    0 0 0 1 0"/>
            </filter>
        </defs>
    </svg>
</head>
<body class="bg-ink-900 text-ivory-200">
    @php
        $navLinks = [
            ['label' => 'الرئيسية', 'route' => 'home'],
            ['label' => 'من نحن', 'route' => 'about'],
            ['label' => 'خدماتنا', 'route' => 'services'],
            ['label' => 'اتصل بنا', 'route' => 'contact'],
        ];
    @endphp

    <!-- Header -->
    <div class="topbar-attorney">
        <div class="container topbar-inner">
            <div class="topbar-contact">
                <a href="tel:+966111234567" class="topbar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.86 19.86 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.86 19.86 0 0 1 2.08 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    +966 11 123 4567
                </a>
                <a href="mailto:info@lawfirm.sa" class="topbar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    info@lawfirm.sa
                </a>
            </div>
            <div class="topbar-social">
                <span class="topbar-pill">خدمة على مدار الساعة</span>
                <span class="text-sm text-ivory-200/80">استشارة أولية عبر الهاتف مجاناً</span>
            </div>
        </div>
    </div>

    <header class="header-attorney">
        <nav class="container">
            <div class="flex items-center justify-between gap-4">
                <button class="mobile-menu-btn md:hidden" aria-label="فتح القائمة" data-toggle="public-nav">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="logo whitespace-nowrap flex items-center gap-3">
                    <div class="logo-gold flex-shrink-0">
                        <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة">
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="text-xs md:text-sm text-brass-400 tracking-[0.3em] uppercase">AL-ARGHANI LAW</span>
                        <span class="font-extrabold text-lg md:text-2xl text-ivory-50">شركة مسفر محمد العرجاني</span>
                        <span class="text-xs text-ivory-200/70">للمحاماة والاستشارات القانونية</span>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-1">
                    @foreach ($navLinks as $link)
                        <a href="{{ route($link['route']) }}"
                           class="nav-link {{ request()->routeIs($link['route']) ? 'active' : '' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('client.login') }}" class="btn-attorney-secondary">دخول العملاء</a>
                    <a href="{{ route('contact') }}" class="btn-attorney-primary hidden sm:inline-flex">استشارة عاجلة</a>
                </div>
            </div>

            <div class="md:hidden mt-4 space-y-2 hidden" id="public-nav-panel">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="block nav-link {{ request()->routeIs($link['route']) ? 'active' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="section-shell">
        <div class="container space-y-10">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-attorney">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="logo-gold">
                            <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة" class="h-10 w-auto">
                        </div>
                        <h3>شركة مسفر محمد العرجاني</h3>
                    </div>
                    <p>نقدم حلولًا قانونية متكاملة تعتمد على الخبرة والدقة والسرعة في الإنجاز.</p>
                    <div class="glass-panel space-y-1">
                        <p class="font-semibold text-ivory-50">خدمة الطوارئ القانونية</p>
                        <a href="tel:+966111234567" class="text-brass-400 text-lg font-bold">+966 11 123 4567</a>
                    </div>
                </div>

                <div>
                    <h3>روابط سريعة</h3>
                    <ul>
                        @foreach ($navLinks as $link)
                            <li><a href="{{ route($link['route']) }}">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3>مجالات التخصص</h3>
                    <ul>
                        <li>القضايا التجارية</li>
                        <li>التقاضي والتحكيم</li>
                        <li>إدارة قضايا الشركات</li>
                        <li>الاستشارات الشرعية والقانونية</li>
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
                    <a href="{{ route('contact') }}" class="btn-attorney-secondary mt-3 inline-flex">حجز موعد</a>
                </div>
            </div>
            <div class="border-t border-white/15 pt-6 text-center text-sm text-white/70">
                <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.querySelector('[data-toggle="public-nav"]');
            const panel = document.getElementById('public-nav-panel');
            if (!toggleBtn || !panel) return;
            toggleBtn.addEventListener('click', () => {
                panel.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>

