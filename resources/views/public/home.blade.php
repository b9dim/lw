@extends('layouts.public')

@section('title', 'الرئيسية')

@section('content')
<!-- Hero Section -->
<section id="hero" class="py-20 bg-gradient-to-br from-primaryDark via-deep to-black shadow-inner">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-14 items-center">
        <div>
            <span class="inline-flex items-center gap-2 bg-white/10 border border-gold/40 px-4 py-1 rounded-full text-gold text-sm mb-4 shadow">
                <span class="w-2 h-2 rounded-full bg-gold"></span>
                استشارات قانونية بخبرة عالية
            </span>

            <h2 class="text-5xl font-extrabold leading-snug mb-6 text-white">
                نحمي حقوقك
                <span class="text-gold">ونبني دفاعك</span>
                القانوني باحترافية.
            </h2>

            <p class="text-gray-300 leading-relaxed mb-6 text-lg">
                تمثيل قانوني متكامل للشركات والأفراد تحت أعلى درجات السرية، الحرفية، والخبرة العملية داخل الأنظمة السعودية.
            </p>

            <div class="flex flex-wrap gap-4 mb-8">
                <a href="{{ route('contact') }}" class="px-8 py-3 rounded-full bg-gold text-deep font-bold text-lg hover:bg-[#A0842F] shadow-xl transition">
                    ابدأ الآن
                </a>

                <a href="{{ route('services') }}" class="px-8 py-3 rounded-full border border-gold text-gold font-bold hover:bg-gold hover:text-deep transition">
                    خدماتنا
                </a>
            </div>

            <!-- إحصائيات -->
            <div class="flex gap-12 text-gray-200">
                <div>
                    <strong class="block text-3xl text-gold">+250</strong>
                    <span class="text-sm">قضية ناجحة</span>
                </div>
                <div>
                    <strong class="block text-3xl text-gold">10+</strong>
                    <span class="text-sm">سنوات خبرة</span>
                </div>
            </div>
        </div>

        <!-- بطاقة جانبية -->
        <div class="bg-black/40 backdrop-blur-xl border border-gold/30 rounded-3xl p-8 shadow-2xl">
            <h3 class="text-xl font-bold text-gold mb-3">استشارة قانونية أولية</h3>
            <p class="text-gray-300 text-sm mb-6">سنقوم بالتواصل معك خلال يوم عمل واحد.</p>

            <ul class="space-y-4 text-gray-300 mb-6">
                <li class="flex items-center gap-3">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full bg-emerald-200 text-emerald-900">✓</span>
                    تحليل موقفك القانوني
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full bg-emerald-200 text-emerald-900">✓</span>
                    تحديد الخيارات القانونية
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full bg-emerald-200 text-emerald-900">✓</span>
                    تقدير المدة والتكلفة
                </li>
            </ul>

            <div class="bg-primaryDark p-5 rounded-2xl shadow-lg border border-gold/30">
                <div class="text-gray-300 text-sm">الهاتف</div>
                <div class="text-xl font-bold text-white mb-3">+966 XX XXX XXXX</div>
                <div class="text-gray-300">info@lawfirm.sa</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section id="services" class="py-20">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <h2 class="section-title">خدماتنا</h2>
        <p class="section-subtitle">نقدم خدمات قانونية شاملة للشركات والأفراد</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="service-card">
                <div class="service-icon">⚖️</div>
                <h3>القضايا المدنية</h3>
                <p>متابعة القضايا المدنية والتجارية بكفاءة عالية مع فريق من المحامين المتخصصين</p>
            </div>
            <div class="service-card">
                <div class="service-icon">📋</div>
                <h3>الاستشارات القانونية</h3>
                <p>استشارات قانونية متخصصة في مختلف المجالات مع تحليل دقيق للوضع القانوني</p>
            </div>
            <div class="service-card">
                <div class="service-icon">📄</div>
                <h3>صياغة العقود</h3>
                <p>صياغة ومراجعة العقود والاتفاقيات القانونية باحترافية عالية</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🏛️</div>
                <h3>القضايا الجنائية</h3>
                <p>الدفاع في القضايا الجنائية مع خبرة واسعة في هذا المجال</p>
            </div>
            <div class="service-card">
                <div class="service-icon">💼</div>
                <h3>القضايا العمالية</h3>
                <p>متابعة القضايا العمالية والدفاع عن حقوق العمال وأصحاب العمل</p>
            </div>
            <div class="service-card">
                <div class="service-icon">📊</div>
                <h3>القضايا الإدارية</h3>
                <p>متابعة القضايا الإدارية والطعون على القرارات الإدارية</p>
            </div>
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="btn-attorney-primary">عرض جميع الخدمات</a>
        </div>
    </div>
</section>

<!-- Ratings Section -->
@if($ratings->count() > 0)
<section class="py-20 bg-deep">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <h2 class="section-title">آراء عملائنا</h2>
        <p class="section-subtitle">ماذا يقول عملاؤنا عن خدماتنا</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ratings as $rating)
                <div class="bg-primaryDark text-white rounded-3xl shadow-xl p-10 relative overflow-hidden border border-gold/30">
                    <span class="absolute text-[140px] opacity-10 top-0 right-5">"</span>
                    <div class="relative z-10">
                        <h3 class="font-bold text-xl mb-1">{{ $rating->client->name }}</h3>
                        <p class="text-sm text-gray-300 mb-5">عميل</p>
                        @if($rating->comment)
                            <p class="leading-relaxed text-gray-200 text-lg mb-5">{{ $rating->comment }}</p>
                        @endif
                        <div class="flex gap-1 text-yellow-300 text-xl">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $rating->rating ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- About Preview -->
<section id="about" class="py-20 bg-primaryDark/30 backdrop-blur">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-extrabold text-gold mb-5">من نحن</h2>
                <p class="text-gray-300 leading-relaxed mb-6 text-lg">
                    نحن مكتب قانوني يوفر خدمات المحاماة والاستشارات القانونية باحترافية عالية،
                    مع فريق متخصص في الأنظمة السعودية الحديثة.
                </p>
                <div class="border-r-4 border-gold pr-4 text-gray-300 mb-8">
                    نعمل على بناء استراتيجيات قانونية قوية تحمي مصالح العملاء وتعزز مراكزهم القانونية.
                </div>
                <!-- الإحصائيات -->
                <div class="grid grid-cols-3 gap-6 text-center">
                    <div>
                        <div class="text-3xl font-bold text-gold">+250</div>
                        <div class="text-gray-400 text-sm">قضية ناجحة</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-gold">10+</div>
                        <div class="text-gray-400 text-sm">سنوات خبرة</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-gold">95%</div>
                        <div class="text-gray-400 text-sm">رضا العملاء</div>
                    </div>
                </div>
            </div>
            <div class="bg-black/40 backdrop-blur-xl border border-gold/30 rounded-3xl p-8 shadow-2xl">
                <h3 class="font-bold text-2xl text-gold mb-5">لماذا نحن؟</h3>
                <ul class="space-y-3 text-gray-300">
                    <li>• خبرة واسعة في الأنظمة السعودية</li>
                    <li>• متابعة دقيقة لكل مراحل القضية</li>
                    <li>• شفافية تامة مع العملاء</li>
                    <li>• التزام بالسرية المهنية</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

