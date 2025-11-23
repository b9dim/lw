@extends('layouts.public')

@section('title', 'الرئيسية')

@section('content')
<section class="hero-attorney">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] items-center">
            <div class="space-y-8 text-white">
                <span class="public-pill text-sm tracking-[0.2em] uppercase">
                    شريكك القانوني الموثوق
                </span>
                <div class="space-y-4">
                    <h1>شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية</h1>
                    <h2>خبرات متراكمة تتجاوز عشرة أعوام في تمثيل الشركات والأفراد داخل المملكة.</h2>
                    <p>
                        نضم نخبة من المحامين والمستشارين الأكفاء الذين باشروا عدداً ضخماً من القضايا في مختلف 
                        المنازعات التجارية، الحقوقية، العمالية، المصرفية، الجزائية، الأحوال الشخصية والإدارية، بالإضافة إلى صياغة ومراجعة جميع أنواع العقود.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('contact') }}" class="btn-attorney-primary">احجز استشارة فورية</a>
                    <a href="https://wa.me/966509579993" target="_blank" rel="noopener" class="btn-attorney-secondary btn-on-dark">
                        <i class="fab fa-whatsapp text-xl"></i>
                        تواصل واتساب
                    </a>
                </div>
                <div class="public-hero-stats">
                    <div>
                        <h4>10+</h4>
                        <span>سنوات من الخبرة المتخصصة</span>
                    </div>
                    <div>
                        <h4>500+</h4>
                        <span>قضية ناجحة ومكتملة</span>
                    </div>
                    <div>
                        <h4>120+</h4>
                        <span>عقد تمت صياغته ومراجعته</span>
                    </div>
                </div>
            </div>
            <div class="public-hero-card space-y-8">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/logo.svg') }}" alt="شعار الشركة" class="h-16 w-auto">
                    <div>
                        <p class="text-sm uppercase tracking-wide text-white/70">جاهزون لخدمتك</p>
                        <h3 class="text-2xl font-bold">مكتب قانوني سعودي بمعايير عالمية</h3>
                    </div>
                </div>
                <div class="grid gap-4">
                    <div class="flex items-center justify-between bg-white/10 rounded-2xl px-4 py-3">
                        <div>
                            <p class="text-white/60 text-sm">الهاتف</p>
                            <a href="tel:+966111234567" class="text-white text-lg font-semibold">+966 11 123 4567</a>
                        </div>
                        <span class="text-white/70 text-2xl">📞</span>
                    </div>
                    <div class="flex items-center justify-between bg-white/10 rounded-2xl px-4 py-3">
                        <div>
                            <p class="text-white/60 text-sm">البريد الإلكتروني</p>
                            <a href="mailto:info@lawfirm.sa" class="text-white text-lg font-semibold">info@lawfirm.sa</a>
                        </div>
                        <span class="text-white/70 text-2xl">✉️</span>
                    </div>
                </div>
                <div class="bg-white/10 rounded-3xl p-5 border border-white/20">
                    <p class="text-sm text-white/70 mb-3">نطاق العمل</p>
                    <p class="text-white leading-relaxed">
                        تمثيل قانوني شامل للشركات والأفراد في الرياض وجدة والمدينة المنورة مع متابعة رقمية لمستجدات القضايا.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-20 bg-[#f1f5ff]">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <div class="grid gap-10 lg:grid-cols-2">
            <div class="public-section space-y-6">
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-blue-500">من نحن</p>
                    <h2 class="text-3xl font-extrabold text-[#022b6d]">منهجية قانونية متكاملة لخدمة أعمالك</h2>
                </div>
                <p class="text-lg text-[#1f2a37] leading-relaxed">
                    نحن شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية، نعمل بخبرة تتجاوز (10) أعوام في 
                    المملكة العربية السعودية، وباشرنا خلالها عدداً ضخماً من القضايا في مختلف أنواع المنازعات. نتولى صياغة
                    ومراجعة جميع أنواع العقود اللازمة لتسيير الأعمال التجارية والمهنية، بدءاً من عقود البيع والإجارة والشراكات 
                    وحتى الامتياز التجاري والتوريد والمقاولات.
                </p>
                <p class="text-lg text-[#1f2a37] leading-relaxed">
                    يمتلك فريقنا نخبة من المحامين والمستشارين المختارين بعناية لتقديم خدمة قانونية مميزة وسريعة، مع متابعة 
                    دقيقة لكل التفاصيل لضمان أفضل نتيجة لعملائنا.
                </p>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach([
                        'قضايا تجارية وحقوقية',
                        'تمثيل أمام المحاكم',
                        'عقود عمل وشركات',
                        'استشارات مكتوبة ومباشرة'
                    ] as $badge)
                        <span class="flex items-center justify-between rounded-2xl border border-blue-100 bg-white px-4 py-3 text-sm font-semibold text-[#022b6d] shadow-sm">
                            {{ $badge }}
                            <i class="fa-solid fa-check text-[#00bff3]"></i>
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="space-y-6">
                <div class="public-section bg-white shadow-xl">
                    <p class="text-sm text-blue-500 font-semibold mb-3">نخدم أعمالك عبر</p>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <p class="text-4xl font-black text-[#0f62ff] mb-1">24/7</p>
                            <p class="text-sm text-[#5f6c82]">متابعة رقمية لحالة القضايا</p>
                        </div>
                        <div>
                            <p class="text-4xl font-black text-[#0f62ff] mb-1">+15</p>
                            <p class="text-sm text-[#5f6c82]">مجال تخصص قانوني</p>
                        </div>
                    </div>
                    <ul class="mt-6 space-y-3 text-[#1f2a37]">
                        <li class="flex items-center gap-2"><span class="text-blue-500">●</span> تقارير دورية لمديري الشركات</li>
                        <li class="flex items-center gap-2"><span class="text-blue-500">●</span> فريق إجرائي في الرياض، جدة، والمدينة</li>
                        <li class="flex items-center gap-2"><span class="text-blue-500">●</span> عقود مخصصة تلائم احتياجاتك</li>
                    </ul>
                </div>
                <div class="rounded-3xl bg-gradient-to-br from-[#0f62ff] to-[#022b6d] text-white p-8 shadow-2xl">
                    <p class="text-sm uppercase tracking-[0.25em] text-white/70 mb-2">أكثر من 10 أعوام خبرة</p>
                    <h3 class="text-2xl font-bold mb-4">ثقة تمتد عبر قطاعات متنوعة</h3>
                    <p class="leading-relaxed text-white/85">
                        تعاملنا مع قطاعات التجارة، التمويل، الطاقة، المقاولات، الشركات العائلية، والقطاع غير الربحي، مع التزام 
                        كامل بسرية البيانات ودقة الإجراءات.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="teams" class="py-20">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <h2 class="section-title">أقسام فريق العمل</h2>
        <p class="section-subtitle">نغطي جميع مراحل العمل القانوني من الاستشارة وحتى التنفيذ الميداني</p>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @php
                $teams = [
                    [
                        'icon' => 'fa-users-gear',
                        'title' => 'القسم الإداري',
                        'body' => 'يتولى التواصل المباشر مع الشركات واستقبال الأعمال القانونية واستكمال بياناتها قبل تحويلها إلى الأقسام المختصة.'
                    ],
                    [
                        'icon' => 'fa-scale-balanced',
                        'title' => 'القسم الفني',
                        'body' => 'يتكون من مستشارين قانونيين بخبرة 5-10 سنوات لصياغة العقود وكتابة المذكرات وتقديم الاستشارات المكتوبة.'
                    ],
                    [
                        'icon' => 'fa-gavel',
                        'title' => 'القسم الإجرائي',
                        'body' => 'شبكة محامين في الرياض وجدة والمدينة لتولي المرافعات والتحقيقات وتمثيل العملاء أمام المحاكم والجهات الرسمية.'
                    ],
                ];
            @endphp
            @foreach($teams as $team)
                <div class="service-card">
                    <div class="service-icon text-2xl">
                        <i class="fa-solid {{ $team['icon'] }}"></i>
                    </div>
                    <h3>{{ $team['title'] }}</h3>
                    <p>{{ $team['body'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="serv" class="py-20 bg-[#edf3ff]">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <div class="flex flex-col items-center text-center mb-12">
            <h2 class="section-title mb-4">مجالات خدماتنا</h2>
            <p class="section-subtitle mb-0">حلول قانونية متخصصة تغطي احتياجات الشركات والأفراد</p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @php
                $homeServices = [
                    [
                        'title' => 'كتابة المذكرات واللوائح',
                        'desc' => 'صياغة مذكرات قانونية دقيقة ودعم فرق المحامين بالمرافعات المدروسة.',
                        'points' => ['مذكرات الدفاع', 'اللوائح الاعتراضية', 'المرافعات الشرعية']
                    ],
                    [
                        'title' => 'خدمات مخصصة للشركات',
                        'desc' => 'استشارات استراتيجية وعقود تشغيلية تحمي مصالح شركتك.',
                        'points' => ['حوكمة وتأسيس', 'عقود توريد ومقاولات', 'دعم قانوني مستمر']
                    ],
                    [
                        'title' => 'تمثيل أمام المحاكم',
                        'desc' => 'مرافعة وحضور جلسات في القضايا التجارية والعمالية والإدارية.',
                        'points' => ['متابعة إلكترونية', 'تقارير دورية', 'استئناف وتنفيذ']
                    ],
                    [
                        'title' => 'قسم دعم المحامين',
                        'desc' => 'فريق متخصص يساند المحامين في البحوث وصياغة المذكرات الكبرى.',
                        'points' => ['أبحاث قانونية', 'تدقيق مستندات', 'إعداد ملفات القضايا']
                    ],
                ];
            @endphp
            @foreach($homeServices as $service)
                <div class="bg-white rounded-3xl border border-blue-100 p-8 flex flex-col gap-4 shadow-lg hover:-translate-y-2 transition">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-[#022b6d]">{{ $service['title'] }}</h3>
                        <span class="text-3xl">⚖️</span>
                    </div>
                    <p class="text-[#5f6c82] leading-relaxed">{{ $service['desc'] }}</p>
                    <ul class="space-y-2 text-sm text-[#1f2a37] font-semibold">
                        @foreach($service['points'] as $point)
                            <li class="flex items-center gap-2"><span class="text-[#00bff3]">▸</span>{{ $point }}</li>
                        @endforeach
                    </ul>
                    <div class="pt-4">
                        <a href="{{ route('services') }}" class="text-[#0056d6] font-bold hover:underline">استكشف الخدمة</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if($ratings->count() > 0)
<section class="py-20 bg-gradient-to-br from-[#01204c] via-[#032c6c] to-[#011536] text-white">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <div class="text-center mb-12">
            <p class="text-sm uppercase tracking-[0.3em] text-white/60 mb-3">آراء عملائنا</p>
            <h2 class="text-3xl md:text-4xl font-extrabold">ماذا قال عملاؤنا عن التجربة؟</h2>
        </div>
        <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">
            @foreach($ratings as $rating)
                <div class="bg-white text-[#0f172a] rounded-3xl p-8 relative shadow-2xl">
                    <span class="absolute text-[80px] text-[#e6ecff] left-6 top-0">“</span>
                    <div class="relative space-y-4">
                        <div>
                            <h3 class="text-xl font-bold text-[#022b6d]">{{ $rating->client->name }}</h3>
                            <p class="text-sm text-[#5f6c82]">عميل</p>
                        </div>
                        @if($rating->comment)
                            <p class="leading-relaxed text-[#1f2a37]">{{ $rating->comment }}</p>
                        @endif
                        <div class="flex gap-1 text-amber-400 text-xl">
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

<section class="py-16">
    <div class="container mx-auto px-6 md:px-10 lg:px-16">
        <div class="public-section bg-gradient-to-br from-white to-[#f4f7ff] flex flex-col lg:flex-row items-center gap-8">
            <div class="flex-1 space-y-4">
                <p class="text-sm text-blue-500 font-semibold">جاهزون لتلبية متطلباتك</p>
                <h2 class="text-3xl font-bold text-[#022b6d]">ابدأ شراكة قانونية طويلة المدى</h2>
                <p class="text-[#1f2a37]">
                    تواصل معنا الآن لتحصل على خطة قانونية متكاملة تحافظ على حقوقك وتواكب نمو أعمالك.
                </p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('contact') }}" class="btn-attorney-primary">حجز موعد</a>
                <a href="{{ route('services') }}" class="btn-attorney-secondary">تعرّف على خدماتنا</a>
            </div>
        </div>
    </div>
</section>
@endsection
