<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية')</title>
    @include('components.vite-assets', ['assets' => ['resources/css/app.css', 'resources/js/app.js']])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<body class="bg-[#f5f7fb] text-[#0f172a]">
    <!-- Header -->
    <header class="header-attorney">
        <nav class="container mx-auto">
            <div class="flex flex-wrap items-center gap-3 px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 md:flex-nowrap md:items-center md:justify-between">
                <div class="flex items-center justify-between gap-4 md:gap-6">
                    <a href="{{ route('home') }}" class="logo whitespace-nowrap flex items-center gap-4 z-10">
                        <div class="logo-gold flex-shrink-0 bg-white rounded-2xl px-3 py-2 shadow-md border border-slate-100">
                            <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة" class="h-12 w-auto md:h-14">
                        </div>
                        <div class="flex flex-col flex-shrink-0 leading-tight logo-text">
                            <span class="font-extrabold text-lg md:text-xl text-[#022b6d] logo-title">شركة مسفر محمد العرجاني</span>
                            <span class="text-sm text-[#5f6c82] logo-subtitle">للمحاماة والاستشارات القانونية</span>
                        </div>
                    </a>
                    <div class="flex items-center gap-2 md:hidden mobile-header-controls">
                        <a href="{{ route('client.login') }}" class="mobile-login-button" aria-label="دخول العملاء">
                            <i class="fa-solid fa-user-lock" aria-hidden="true"></i>
                            <span>دخول</span>
                        </a>
                        <button type="button"
                            class="mobile-menu-toggle"
                            data-mobile-menu-toggle
                            aria-controls="publicMobileNav"
                            aria-expanded="false">
                            <span class="sr-only">فتح القائمة الرئيسية</span>
                            <span class="mobile-menu-bars" aria-hidden="true">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-reverse space-x-2 flex-1 justify-center md:justify-start">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">من نحن</a>
                    <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">خدماتنا</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">اتصل بنا</a>
                </div>
                <div class="hidden md:flex items-center gap-3 flex-shrink-0 z-10">
                    <a href="{{ route('contact') }}" class="btn-attorney-primary">احجز استشارة</a>
                    <a href="{{ route('client.login') }}" class="btn-attorney-secondary whitespace-nowrap flex items-center gap-2">
                        <span>دخول العملاء</span>
                    </a>
                </div>
            </div>
            <div id="publicMobileNav" class="mobile-menu-panel md:hidden" aria-hidden="true">
                <div class="mobile-menu-inner">
                    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
                    <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">من نحن</a>
                    <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->routeIs('services') ? 'active' : '' }}">خدماتنا</a>
                    <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">اتصل بنا</a>
                    <div class="mobile-menu-cta">
                        <a href="{{ route('contact') }}" class="btn-attorney-primary w-full text-center">احجز استشارة</a>
                        <a href="{{ route('client.login') }}" class="btn-attorney-secondary w-full text-center">دخول العملاء</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-attorney">
        <div class="container mx-auto px-6 md:px-8 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="logo-gold">
                            <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة" class="h-10 w-auto">
                        </div>
                        <h3>شركة مسفر محمد العرجاني</h3>
                    </div>
                    <p>
                        للمحاماة والاستشارات القانونية
                    </p>
                    <p class="mt-4">
                        نقدم خدمات قانونية متخصصة واحترافية لعملائنا الكرام
                    </p>
                </div>
                <div>
                    <h3>روابط سريعة</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('about') }}">من نحن</a></li>
                        <li><a href="{{ route('services') }}">خدماتنا</a></li>
                        <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                    </ul>
                </div>
                <div>
                    <h3>خدماتنا</h3>
                    <ul>
                        <li><a href="{{ route('services') }}">القضايا المدنية</a></li>
                        <li><a href="{{ route('services') }}">الاستشارات القانونية</a></li>
                        <li><a href="{{ route('services') }}">صياغة العقود</a></li>
                        <li><a href="{{ route('services') }}">القضايا الجنائية</a></li>
                    </ul>
                </div>
                <div>
                    <h3>معلومات الاتصال</h3>
                    <p class="mb-3">
                        <strong>البريد الإلكتروني:</strong><br>
                        <a href="mailto:info@lawfirm.sa">info@lawfirm.sa</a>
                    </p>
                    <p class="mb-3">
                        <strong>الهاتف:</strong><br>
                        <a href="tel:+966111234567">+966 11 123 4567</a>
                    </p>
                    <p>
                        <strong>العنوان:</strong><br>
                        الرياض، المملكة العربية السعودية
                    </p>
                </div>
            </div>
            <div class="border-t border-white border-opacity-20 pt-6 text-center">
                <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية</p>
            </div>
        </div>
    </footer>
</body>
</html>

