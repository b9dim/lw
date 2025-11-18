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
    <header class="header-attorney header-client" id="clientHeader">
        <nav class="container mx-auto">
            <div class="flex items-center justify-between gap-4 px-6 md:px-8 lg:px-12 xl:px-16">
                <div class="flex items-center space-x-reverse space-x-6 md:space-x-10 flex-shrink-0">
                    <a href="{{ route('home') }}" class="logo whitespace-nowrap flex items-center gap-3 z-10">
                        <div class="logo-gold flex-shrink-0">
                            <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة" class="h-12 w-auto">
                        </div>
                        <div class="flex flex-col flex-shrink-0">
                            <span class="font-extrabold text-lg leading-tight">شركة مسفر محمد العرجاني</span>
                            <span class="text-sm text-gold/80">للمحاماة والاستشارات القانونية</span>
                        </div>
                    </a>
                    <div class="hidden md:flex items-center space-x-reverse space-x-2">
                        <a href="{{ route('client.dashboard') }}" class="nav-link {{ request()->routeIs('client.*') ? 'active' : '' }}">لوحة العميل</a>
                    </div>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0 z-10">
                    <a href="{{ route('client.dashboard') }}" class="btn-attorney-secondary text-sm flex items-center gap-2">
                        <span>جميع قضاياي</span>
                    </a>
                    <form method="POST" action="{{ force_https_route('client.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-attorney-secondary text-sm">
                            تسجيل الخروج
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 md:px-8 lg:px-12 pt-24 py-8 main-client-content">
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

    <script>
        // Calculate header height dynamically and set padding
        (function() {
            const header = document.getElementById('clientHeader');
            const mainContent = document.querySelector('.main-client-content');
            
            if (!header || !mainContent) return;
            
            function updatePadding() {
                // Force reflow to get accurate height
                header.style.display = 'block';
                const headerHeight = header.offsetHeight;
                // Add extra 30px for safety margin (increased for better spacing)
                const paddingValue = Math.max(headerHeight + 30, 120); // Minimum 120px
                mainContent.style.paddingTop = paddingValue + 'px';
            }
            
            // Wait for DOM to be fully loaded
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(updatePadding, 100);
                });
            } else {
                // DOM already loaded
                setTimeout(updatePadding, 100);
            }
            
            // Update on resize with debounce
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    updatePadding();
                }, 150);
            }, { passive: true });
            
            // Update when header visibility changes (when hidden class is toggled)
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        // Small delay to ensure height is calculated after class change
                        setTimeout(updatePadding, 50);
                    }
                });
            });
            observer.observe(header, {
                attributes: true,
                attributeFilter: ['class'],
                childList: false,
                subtree: false
            });
            
            // Update when window orientation changes (for mobile)
            window.addEventListener('orientationchange', function() {
                setTimeout(updatePadding, 300);
            });
            
            // Update periodically to catch any dynamic changes (less frequent)
            setInterval(updatePadding, 1000);
        })();
        
        // Hide header on scroll down, show on scroll up
        (function() {
            let lastScrollTop = 0;
            const header = document.getElementById('clientHeader');
            if (!header) return;
            
            let scrollTimeout;
            let ticking = false;

            function handleScroll() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                        
                        clearTimeout(scrollTimeout);
                        
                        if (scrollTop > lastScrollTop && scrollTop > 100) {
                            // Scrolling down - hide header
                            header.classList.add('hidden');
                        } else if (scrollTop < lastScrollTop) {
                            // Scrolling up - show header
                            header.classList.remove('hidden');
                        }
                        
                        // At top of page - always show
                        if (scrollTop <= 50) {
                            header.classList.remove('hidden');
                        }
                        
                        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                        ticking = false;
                    });
                    ticking = true;
                }
            }

            window.addEventListener('scroll', handleScroll, { passive: true });
        })();
    </script>

</body>
</html>

