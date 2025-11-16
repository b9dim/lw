@extends('layouts.public')

@section('title', '404 - الصفحة غير موجودة')

@section('content')
<section class="py-20 bg-section-light min-h-screen flex items-center">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="max-w-2xl mx-auto text-center">
            <div class="mb-8">
                <div class="inline-block mb-6">
                    <div class="icon-circle icon-circle-lg icon-circle-accent mx-auto">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-8xl font-bold text-primary mb-4">404</h1>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">الصفحة غير موجودة</h2>
                <p class="text-gray-600 text-lg mb-8">
                    عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى مكان آخر.
                </p>
            </div>

            <div class="card-dashboard p-8 mb-8">
                <h3 class="text-xl font-bold text-primary mb-4">ما الذي يمكنك فعله؟</h3>
                <ul class="text-right space-y-3 text-gray-700 mb-6">
                    <li class="flex items-start gap-3">
                        <span class="text-primary font-bold">•</span>
                        <span>تأكد من صحة رابط الصفحة</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-primary font-bold">•</span>
                        <span>ارجع إلى الصفحة الرئيسية</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-primary font-bold">•</span>
                        <span>استخدم القائمة العلوية للتنقل</span>
                    </li>
                </ul>
            </div>

            <div class="flex gap-4 justify-center flex-wrap">
                <a href="{{ route('home') }}" class="btn-attorney-primary">
                    العودة إلى الصفحة الرئيسية
                </a>
                <a href="javascript:history.back()" class="btn-attorney-secondary">
                    العودة للخلف
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

