@extends('layouts.public')

@section('title', 'الرئيسية')

@section('content')
    <section class="landing-hero">
        <div class="hero-grid">
            <div class="space-y-6">
                <div class="hero-eyebrow">
                    <span></span>
                    مكتب سعودي مرخص
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-snug text-ivory-50">
                    حماية قانونية متكاملة
                    <span class="text-gold">للشركات والأفراد</span>
                    في المملكة.
                </h1>
                <p class="hero-lead">
                    نمثل موكلينا أمام الجهات القضائية والهيئات التنظيمية بخبرة تتجاوز عشر سنوات،
                    مع التزام صارم بالسرية وجودة المرافعات.
                </p>
                <ul class="hero-list">
                    <li>استجابة فورية للقضايا العاجلة وخطط دفاع مدروسة</li>
                    <li>فِرق مختصة في التقاضي التجاري والحوكمة والشركات</li>
                    <li>بوابة رقمية لمتابعة التحديثات والمستندات في الوقت الفعلي</li>
                </ul>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="btn-attorney-primary">
                        طلب استشارة عاجلة
                    </a>
                    <a href="{{ route('services') }}" class="btn-attorney-secondary">
                        التعرف على خدماتنا
                    </a>
                </div>
                <div class="hero-metrics">
                    <div class="hero-metric">
                        <strong>+250</strong>
                        <span>قضية منجزة بنجاح</span>
                    </div>
                    <div class="hero-metric">
                        <strong>10+</strong>
                        <span>سنوات خبرة متخصصة</span>
                    </div>
                    <div class="hero-metric">
                        <strong>95%</strong>
                        <span>مؤشر رضا العملاء</span>
                    </div>
                </div>
            </div>
            <div class="hero-panel">
                <h3>مركز الاستجابة القانونية</h3>
                <p>فريق محامين جاهز لمراجعة ملفك والرد خلال يوم عمل واحد.</p>
                <ul>
                    <li><span>✓</span> تشخيص أولي للحالة القانونية</li>
                    <li><span>✓</span> تحديد المخاطر والفرص والمدة المتوقعة</li>
                    <li><span>✓</span> تقديم عرض أتعاب شفاف وخطة متابعة</li>
                </ul>
                <div class="contact-pill">
                    <small class="text-sm text-white/70">رقم الطوارئ القانوني</small>
                    <strong>+966 11 123 4567</strong>
                    <a href="mailto:info@lawfirm.sa" class="text-brass-400 text-sm">info@lawfirm.sa</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container space-y-8">
            <div class="text-center space-y-3 max-w-3xl mx-auto">
                <p class="text-gold uppercase tracking-[0.4em] text-xs">قيم مضافة</p>
                <h2 class="section-title">شركاء استراتيجيون للقطاعين الحكومي والخاص</h2>
                <p class="section-subtitle">
                    نرافق عملاءنا في الملفات التجارية، والتحكيم، وحوكمة الشركات عبر فرق قانونية متخصصة
                    وأدوات رقمية تسهّل المتابعة والتوثيق.
                </p>
            </div>
            <div class="trust-grid">
                <div class="trust-card">
                    <span>+40</span>
                    شركة سعودية تحت المتابعة الدائمة
                </div>
                <div class="trust-card">
                    <span>15</span>
                    محام ومستشار متخصص
                </div>
                <div class="trust-card">
                    <span>24/7</span>
                    خدمة عملاء للحالات الحرجة
                </div>
                <div class="trust-card">
                    <span>2</span>
                    مكاتب رئيسية في الرياض وجدة
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="section-shell section-muted">
        <div class="space-y-10">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="section-title">مجالات خبرتنا</h2>
                <p class="section-subtitle">
                    نخدم الشركات ورواد الأعمال والأفراد عبر منظومة خدمات قانونية تغطي
                    الاستشارات، وإدارة القضايا، وصياغة الاتفاقيات الحرجة.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="service-card">
                    <div class="service-icon">⚖️</div>
                    <h3 class="text-xl font-bold mb-3">التقاضي التجاري</h3>
                    <p>تمثيل أمام المحاكم التجارية وهيئات التحكيم مع إعداد مذكرات مهنية تضمن قوة الموقف.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📑</div>
                    <h3 class="text-xl font-bold mb-3">صياغة العقود</h3>
                    <p>بناء وتدقيق عقود الشراكات، الوكالات، واتفاقيات التمويل بما يحفظ الحقوق ويلتزم بالأنظمة.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🏛️</div>
                    <h3 class="text-xl font-bold mb-3">القضايا الجنائية والعمالية</h3>
                    <p>إجراءات الدفاع في الدعاوى العمالية والجنائية مع إدارة كاملة للتفاوض والتسويات.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🧭</div>
                    <h3 class="text-xl font-bold mb-3">حوكمة الشركات</h3>
                    <p>تصميم سياسات الحوكمة ولوائح المجالس مع متابعة الامتثال الداخلي والخارجي.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🛡️</div>
                    <h3 class="text-xl font-bold mb-3">حل النزاعات</h3>
                    <p>إدارة إجراءات الوساطة والتحكيم وتقديم حلول ودية تحمي العلاقات التجارية.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📊</div>
                    <h3 class="text-xl font-bold mb-3">التقارير القانونية</h3>
                    <p>تقارير دورية للإدارة العليا تتضمن مؤشرات الأداء والمخاطر والتوصيات التنفيذية.</p>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('services') }}" class="btn-attorney-primary inline-flex items-center gap-2">
                    عرض جميع الحلول
                </a>
            </div>
        </div>
    </section>

    <section id="about" class="section-shell section-gradient text-white">
        <div class="container grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="space-y-6">
                <h2 class="text-4xl font-extrabold text-gold">منهجية عمل واضحة</h2>
                <p class="text-white/80 leading-relaxed">
                    نركز على بناء ملف قانوني متكامل يشمل التحليل، جمع الأدلة، والتواصل المستمر مع الأطراف ذات الصلة.
                    كل ملف يدار بواسطة قائد فريق وخبير مختص في القطاع المعني.
                </p>
                <ul class="hero-list">
                    <li>غرف بيانات آمنة لتبادل المستندات</li>
                    <li>جداول زمنية واضحة ومسؤول اتصال واحد</li>
                    <li>تنبيهات دورية بكل تحديث قضائي</li>
                </ul>
            </div>
            <div class="surface-card">
                <h3 class="text-2xl font-bold text-royal-500 mb-6">لماذا يثق بنا عملاؤنا؟</h3>
                <ul class="space-y-4 text-slate-700">
                    <li class="flex items-start gap-3">
                        <span class="icon-circle icon-circle-sm icon-circle-accent">1</span>
                        <div>
                            <strong class="block">تخصص دقيق</strong>
                            <span class="text-slate-500 text-sm">فرق متخصصة في مجالات البنوك، العقار، الطاقة، والتقنية.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="icon-circle icon-circle-sm icon-circle-accent">2</span>
                        <div>
                            <strong class="block">تواصل شفاف</strong>
                            <span class="text-slate-500 text-sm">تقارير أسبوعية ولوحة معلومات تفاعلية لكل عميل.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="icon-circle icon-circle-sm icon-circle-accent">3</span>
                        <div>
                            <strong class="block">اعتماد محلي ودولي</strong>
                            <span class="text-slate-500 text-sm">عضوية في منظمات مهنية وشراكات مع مكاتب تحكيم دولية.</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    @if($ratings->count() > 0)
        <section class="section-shell">
            <div class="container space-y-8">
                <div class="text-center max-w-2xl mx-auto">
                    <h2 class="section-title">آراء عملائنا</h2>
                    <p class="section-subtitle">انطباعات حقيقية لعملاء أنهينا ملفاتهم بنجاح.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($ratings as $rating)
                        <div class="surface-card relative overflow-hidden">
                            <span class="absolute text-[120px] font-serif text-royal-400/5 top-0 end-4">“</span>
                            <div class="relative space-y-3">
                                <h3 class="text-xl font-bold text-ink-700">{{ $rating->client->name }}</h3>
                                <p class="text-slate-500 text-sm">عميل موثق</p>
                                @if($rating->comment)
                                    <p class="text-slate-700 leading-relaxed">{{ $rating->comment }}</p>
                                @endif
                                <div class="flex gap-1 text-gold text-lg">
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

    <section class="section-shell">
        <div class="container">
            <div class="cta-panel">
                <h3>جاهزون للبدء في ملفك القادم</h3>
                <p>
                    راسلنا أو اتصل بنا لنعين لك مستشاراً قانونياً يتابع احتياجك منذ لحظة الطلب وحتى
                    إغلاق الملف.
                </p>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn-attorney-primary">احجز اجتماعاً الآن</a>
                    <a href="tel:+966111234567" class="btn-attorney-secondary">الاتصال على +966 11 123 4567</a>
                </div>
            </div>
        </div>
    </section>
@endsection

