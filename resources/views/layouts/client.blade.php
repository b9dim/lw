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
<body class="bg-gray-50">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#003C30]/95 backdrop-blur-xl shadow-sm">
        <div class="flex items-center justify-between px-4 py-3">

            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/logo.svg') }}" class="h-8 w-auto rounded-md">
                <div class="leading-tight">
                    <div class="text-white text-sm font-semibold tracking-wide">
                        شركة مسفر محمد العرجاني
                    </div>
                    <div class="text-white/80 text-[11px]">
                        للمحاماة والاستشارات القانونية
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('client.dashboard') }}"
                   class="px-3 py-1.5 text-xs font-medium rounded-full bg-white/15 text-white border border-white/20 backdrop-blur-md transition hover:bg-white/25">
                   جميع قضاياي
                </a>

                <form method="POST" action="{{ force_https_route('client.logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1.5 text-xs font-medium rounded-full bg-white text-[#003C30] border border-transparent hover:opacity-90 transition">
                        تسجيل الخروج
                    </button>
                </form>
            </div>

        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24">
        <div class="container mx-auto px-6 md:px-8 lg:px-12">
            @if(session('success'))
                <div class="bg-green-100 border-r-4 border-green-500 text-green-700 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">✅</span>
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-r-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">⚠️</span>
                        <p class="font-semibold">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-attorney mt-16">
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

