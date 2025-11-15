<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - شركة مسفر محمد العرجاني</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Mobile Menu Button -->
    <button id="mobileMenuBtn" class="mobile-menu-btn" onclick="toggleMobileMenu()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="mobile-overlay" onclick="closeMobileMenu()"></div>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-admin">
            <!-- Mobile Close Button -->
            <button id="mobileCloseBtn" class="mobile-close-btn" onclick="closeMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="px-6 mb-8 pb-6 border-b border-gray-700">
                <h2 class="text-white text-xl font-bold mb-2">لوحة التحكم</h2>
                <div class="flex items-center gap-2 mb-1">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 0115 0" />
                    </svg>
                    <p class="text-white text-sm font-semibold">{{ auth()->user()->name }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5.25v3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75v3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 12h3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 12h3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l3 3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 16.5l3 3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l3-3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 7.5l3-3" />
                        <circle cx="12" cy="12" r="5.25" />
                    </svg>
                    <p class="text-gray-300 text-xs">{{ auth()->user()->role }}</p>
                </div>
            </div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 20V10" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 20v-6" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16" />
                    </svg>
                    الرئيسية
                </a>
                <a href="{{ route('admin.clients.index') }}" class="sidebar-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="9" cy="10" r="3.25" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 20c0-2.9 2.6-5.25 6-5.25s6 2.35 6 5.25" />
                        <circle cx="17" cy="8" r="2.25" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 20v-1c0-1.9-1.2-3.5-2.9-4.27" />
                    </svg>
                    العملاء
                </a>
                <a href="{{ route('admin.cases.index') }}" class="sidebar-link {{ request()->routeIs('admin.cases.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 15l3-7 3 7H3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l3-7 3 7h-6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 20h8" />
                    </svg>
                    القضايا
                </a>
                <a href="{{ route('admin.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10a4 4 0 014 4v2a4 4 0 01-4 4h-3.5L10 21v-4H7a4 4 0 01-4-4v-2a4 4 0 014-4z" />
                    </svg>
                    الاستفسارات
                </a>
                <a href="{{ route('admin.ratings.index') }}" class="sidebar-link {{ request()->routeIs('admin.ratings.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    التقييمات
                </a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 21c0-3.35 3.134-6 7-6s7 2.65 7 6" />
                    </svg>
                    المستخدمون
                </a>
                @endif
            </nav>
            <div class="absolute bottom-0 w-full p-4 border-t border-gray-700">
                <a href="{{ route('logout') }}" class="sidebar-link block text-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 6h4.5a3.5 3.5 0 013.5 3.5v5a3.5 3.5 0 01-3.5 3.5H9" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3M6 9l-3 3 3 3" />
                    </svg>
                    تسجيل الخروج
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 mr-280">
            <div class="container mx-auto px-6 py-8">
                @if(session('success'))
                    <div id="success-notification" class="notification-success mb-6 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="notification-icon-success">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="notification-title">{{ session('success') }}</p>
                                    @if(str_contains(session('success'), 'الموافقة على تقييم'))
                                        <p class="notification-subtitle">سيظهر التقييم الآن في الصفحة الرئيسية</p>
                                    @elseif(str_contains(session('success'), 'حذف تقييم'))
                                        <p class="notification-subtitle">تم إزالة التقييم من النظام بشكل نهائي</p>
                                    @elseif(str_contains(session('success'), 'رفض تقييم'))
                                        <p class="notification-subtitle">لن يظهر هذا التقييم في الصفحة الرئيسية</p>
                                    @endif
                                </div>
                            </div>
                            <button onclick="closeNotification('success-notification')" class="notification-close">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div id="error-notification" class="notification-error mb-6 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="notification-icon-error">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="notification-title">{{ session('error') }}</p>
                                </div>
                            </div>
                            <button onclick="closeNotification('error-notification')" class="notification-close">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            const body = document.body;
            
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('overlay-active');
            body.classList.toggle('menu-open');
        }

        function closeMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            const body = document.body;
            
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('overlay-active');
            body.classList.remove('menu-open');
        }

        // Close menu when clicking on a link
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    closeMobileMenu();
                }
            });
        });

        // Close menu on window resize if screen becomes larger
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                closeMobileMenu();
            }
        });

        // Close notification function
        function closeNotification(id) {
            const notification = document.getElementById(id);
            if (notification) {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 300);
            }
        }

        // Auto-hide success notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successNotification = document.getElementById('success-notification');
            if (successNotification) {
                setTimeout(() => {
                    closeNotification('success-notification');
                }, 5000);
            }
        });
    </script>

    <style>
        /* Desktop: Main content with sidebar margin */
        .mr-280 {
            margin-right: 280px;
            width: calc(100% - 280px);
        }

        /* Ensure main takes full width on desktop */
        @media (min-width: 769px) {
            main {
                width: calc(100% - 280px);
            }
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1001;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .mobile-menu-btn:active {
            transform: translateY(0);
        }

        /* Mobile Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-overlay.overlay-active {
            display: block;
            opacity: 1;
        }

        /* Prevent body scroll when menu is open */
        body.menu-open {
            overflow: hidden;
        }

        /* Mobile Close Button */
        .mobile-close-btn {
            display: none;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1002;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .mobile-close-btn {
                display: block;
            }

            /* Sidebar as overlay on mobile */
            .sidebar-admin {
                transform: translateX(100%);
                transition: transform 0.3s ease;
                z-index: 1000;
                position: fixed;
                top: 0;
                right: 0;
                height: 100vh;
                overflow-y: auto;
            }

            .sidebar-admin.sidebar-open {
                transform: translateX(0);
            }

            /* Main content always full width on mobile */
            .mr-280 {
                margin-right: 0 !important;
                width: 100% !important;
            }

            main {
                width: 100% !important;
                margin-right: 0 !important;
            }

            /* Ensure flex container doesn't affect layout */
            .flex {
                flex-direction: column;
            }

            /* Ensure container doesn't restrict table width */
            .container {
                max-width: 100%;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /* Card padding adjustment for mobile */
            .card-dashboard {
                padding: 1.5rem !important;
            }
        }

        @media (min-width: 769px) {
            .mobile-overlay {
                display: none !important;
            }
        }

        /* Notification Styles */
        .notification-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            border-right: 4px solid #047857;
            transition: all 0.3s ease;
        }

        .notification-error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
            border-right: 4px solid #b91c1c;
            transition: all 0.3s ease;
        }

        .notification-icon-success {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-icon-error {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.5;
        }

        .notification-subtitle {
            font-size: 0.875rem;
            opacity: 0.9;
            margin: 0.25rem 0 0 0;
            line-height: 1.4;
        }

        .notification-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 8px;
            padding: 0.5rem;
            cursor: pointer;
            color: white;
            transition: all 0.2s ease;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .notification-close:active {
            transform: scale(0.95);
        }

        /* Animation */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-down {
            animation: slideDown 0.4s ease-out;
        }

        /* Responsive notifications */
        @media (max-width: 640px) {
            .notification-success,
            .notification-error {
                padding: 1rem;
            }

            .notification-icon-success,
            .notification-icon-error {
                width: 40px;
                height: 40px;
            }

            .notification-title {
                font-size: 1rem;
            }

            .notification-subtitle {
                font-size: 0.8rem;
            }
        }
    </style>
</body>
</html>

