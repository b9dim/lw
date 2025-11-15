@extends('layouts.public')

@section('title', 'اتصل بنا')

@section('content')
<section class="py-24 bg-section-light">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="max-w-5xl mx-auto">
            <h1 class="section-title">اتصل بنا</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                <div class="card-attorney p-10">
                    <h2 class="text-2xl font-bold mb-8 text-primary">معلومات الاتصال</h2>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="icon-circle ml-4 flex-shrink-0 text-primary">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-2 text-lg">البريد الإلكتروني</h4>
                                <p class="text-gray-600">info@lawfirm.sa</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="icon-circle ml-4 flex-shrink-0 text-primary">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-2 text-lg">الهاتف</h4>
                                <p class="text-gray-600">+966 11 123 4567</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="icon-circle ml-4 flex-shrink-0 text-primary">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-2 text-lg">العنوان</h4>
                                <p class="text-gray-600">الرياض، المملكة العربية السعودية</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="icon-circle ml-4 flex-shrink-0 icon-circle-accent">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-2 text-lg">ساعات العمل</h4>
                                <p class="text-gray-600">الأحد - الخميس: 8:00 ص - 5:00 م</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-attorney p-10">
                    <h2 class="text-2xl font-bold mb-8 text-primary">أرسل لنا رسالة</h2>
                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-gray-700 mb-2 font-semibold">الاسم</label>
                            <input type="text" name="name" class="form-input-attorney" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-semibold">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-input-attorney" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-semibold">الموضوع</label>
                            <input type="text" name="subject" class="form-input-attorney" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-semibold">الرسالة</label>
                            <textarea name="message" rows="5" class="form-input-attorney" required></textarea>
                        </div>
                        <button type="submit" class="btn-attorney-primary w-full">إرسال الرسالة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

