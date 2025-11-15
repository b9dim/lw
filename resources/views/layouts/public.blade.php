<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية')</title>
    @include('components.vite-assets', ['assets' => ['resources/css/app.css', 'resources/js/app.js']])
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="header-attorney">
        <nav class="container mx-auto">
            <div class="flex items-center justify-between flex-wrap gap-4 px-6 md:px-8 lg:px-12 xl:px-16">
                <div class="flex items-center space-x-reverse space-x-6 md:space-x-10 flex-1 min-w-0">
                    <a href="{{ route('home') }}" class="logo whitespace-nowrap flex items-center gap-2">
                        <span class="text-2xl">⚖️</span>
                        <span class="font-bold">شركة مسفر محمد العرجاني</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-reverse space-x-2">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
                        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">من نحن</a>
                        <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">خدماتنا</a>
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">اتصل بنا</a>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ secure_url(route('client.login')) }}" class="btn-attorney-secondary whitespace-nowrap flex items-center gap-2">
                        <span>دخول العملاء</span>
                    </a>
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
                    <h3>شركة مسفر محمد العرجاني</h3>
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

