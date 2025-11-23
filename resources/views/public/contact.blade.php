@extends('layouts.public')

@section('title', 'اتصل بنا')

@section('content')
<section class="py-20 bg-gradient-to-br from-[#0f62ff] via-[#0a3a94] to-[#031642] text-white">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <div class="max-w-3xl space-y-6">
            <p class="public-pill text-xs tracking-[0.3em] uppercase">نرحب باستفسارك</p>
            <h1 class="text-4xl font-extrabold leading-tight">تواصل معنا للحصول على استشارة قانونية دقيقة</h1>
            <p class="text-white/80 leading-relaxed">
                نتواجد لخدمة عملائنا من الأحد إلى الخميس، ونوفر قنوات متعددة للتواصل من أجل تقديم الاستشارات والمتابعة الفورية.
            </p>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="public-section bg-white border border-blue-50">
                <h2 class="text-2xl font-bold text-[#022b6d] mb-6">معلومات التواصل</h2>
                <div class="space-y-6 text-[#1f2a37]">
                    <div>
                        <p class="text-sm text-[#5f6c82]">الهاتف</p>
                        <a href="tel:+966111234567" class="text-2xl font-extrabold text-[#0f62ff]">+966 11 123 4567</a>
                    </div>
                    <div>
                        <p class="text-sm text-[#5f6c82]">البريد الإلكتروني</p>
                        <a href="mailto:info@lawfirm.sa" class="text-lg font-semibold text-[#022b6d]">info@lawfirm.sa</a>
                    </div>
                    <div>
                        <p class="text-sm text-[#5f6c82]">العنوان</p>
                        <p class="font-semibold">الرياض – المملكة العربية السعودية</p>
                    </div>
                    <div>
                        <p class="text-sm text-[#5f6c82]">أوقات العمل</p>
                        <p class="font-semibold">الأحد – الخميس: 9 صباحاً – 5 مساءً</p>
                    </div>
                    <div class="grid gap-4 text-sm">
                        <p class="font-semibold text-[#022b6d]">قنوات إضافية</p>
                        <a href="https://wa.me/966509579993" target="_blank" rel="noopener" class="flex items-center gap-3 rounded-2xl border border-blue-100 px-4 py-3 text-[#1f2a37] hover:border-[#0f62ff]">
                            <span class="text-2xl">🟢</span>
                            <span>واتساب مباشر</span>
                        </a>
                        <a href="{{ route('services') }}" class="flex items-center gap-3 rounded-2xl border border-blue-100 px-4 py-3 text-[#1f2a37] hover:border-[#0f62ff]">
                            <span class="text-2xl">📁</span>
                            <span>تعرّف على خدماتنا</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="public-section bg-white border border-blue-50">
                <h2 class="text-2xl font-bold text-[#022b6d] mb-4">أرسل لنا رسالة</h2>
                <p class="text-sm text-[#5f6c82] mb-6">سنتواصل معك خلال يوم عمل واحد لتأكيد الطلب وتحديد الخطوات التالية.</p>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl mb-6 flex items-center gap-3">
                        <span class="text-2xl">✅</span>
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl mb-6">
                        <p class="font-semibold mb-2">يرجى تصحيح الأخطاء التالية:</p>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ force_https_route('contact.store') }}" method="POST" id="contactForm" class="space-y-5">
                    @csrf
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-[#022b6d] mb-1">الاسم الكامل</label>
                            <input type="text" name="name" class="form-input-attorney" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#022b6d] mb-1">رقم الجوال</label>
                            <input type="tel" name="phone" class="form-input-attorney">
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-[#022b6d] mb-1">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-input-attorney" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#022b6d] mb-1">نوع الخدمة المطلوبة</label>
                            <input type="text" name="subject" class="form-input-attorney" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-[#022b6d] mb-1">الرسالة</label>
                        <textarea name="message" rows="5" class="form-input-attorney" required></textarea>
                    </div>
                    <div>
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @error('g-recaptcha-response')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn-attorney-primary w-full justify-center">إرسال الطلب</button>
                </form>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            </div>
        </div>
    </div>
</section>
@endsection
