@extends('layouts.public')

@section('title', 'اتصل بنا')

@section('content')
<section id="contact" class="py-20 bg-primaryDark/20 backdrop-blur">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="max-w-5xl mx-auto">
            <h1 class="section-title">اتصل بنا</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                <div class="bg-primaryDark border border-gold/30 rounded-3xl text-gray-200 p-10 shadow-xl">
                    <h3 class="font-bold text-xl text-gold mb-6">معلومات التواصل</h3>
                    <p class="mb-5">
                        <span class="text-gray-300 text-sm">الهاتف:</span><br>
                        <span class="text-xl font-bold text-white">+966 XX XXX XXXX</span>
                    </p>
                    <p class="mb-5">
                        <span class="text-gray-300 text-sm">البريد:</span><br>
                        info@lawfirm.sa
                    </p>
                    <p class="mb-5">
                        <span class="text-gray-300 text-sm">العنوان:</span><br>
                        الرياض – المملكة العربية السعودية
                    </p>
                    <p>
                        <span class="text-gray-300 text-sm">أوقات العمل:</span><br>
                        الأحد – الخميس: 9 صباحاً – 5 مساءً
                    </p>
                </div>

                <div class="bg-black/40 border border-gold/30 backdrop-blur-xl rounded-3xl p-10 shadow-xl">
                    <h2 class="text-2xl font-bold mb-8 text-gold">أرسل لنا رسالة</h2>
                    
                    @if(session('success'))
                        <div class="bg-green-50 border-r-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">✅</span>
                                <p class="font-semibold">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-50 border-r-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <p class="font-semibold mb-2">يرجى تصحيح الأخطاء التالية:</p>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ force_https_route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gold mb-1">الاسم الكامل</label>
                                <input type="text" name="name" class="w-full bg-deep border border-gold/20 rounded-xl p-3 text-white focus:border-gold" required>
                            </div>
                            <div>
                                <label class="block text-gold mb-1">رقم الجوال</label>
                                <input type="tel" name="phone" class="w-full bg-deep border border-gold/20 rounded-xl p-3 text-white focus:border-gold">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gold mb-1">البريد الإلكتروني</label>
                                <input type="email" name="email" class="w-full bg-deep border border-gold/20 rounded-xl p-3 text-white focus:border-gold" required>
                            </div>
                            <div>
                                <label class="block text-gold mb-1">نوع الخدمة</label>
                                <input type="text" name="subject" class="w-full bg-deep border border-gold/20 rounded-xl p-3 text-white focus:border-gold" required>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gold mb-1">الرسالة</label>
                            <textarea name="message" rows="5" class="w-full bg-deep border border-gold/20 rounded-xl p-3 text-white focus:border-gold" required></textarea>
                        </div>
                        <div>
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                            @error('g-recaptcha-response')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-6 py-3 rounded-full bg-gold text-deep font-bold hover:bg-[#A0842F] shadow-lg transition w-full">إرسال</button>
                    </form>
                    
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

