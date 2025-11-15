@extends('layouts.public')

@section('title', 'الرئيسية')

@section('content')
<!-- Hero Section -->
<section class="hero-attorney">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="max-w-5xl">
            <h1>شركة مسفر محمد العرجاني</h1>
            <h2>للمحاماة والاستشارات القانونية</h2>
            <p>
                نركز على تقديم تمثيل قانوني متميز مع لمسة شخصية. لقد بنينا سمعتنا بشكل أساسي على توصيات عملائنا الراضين، الذين طورنا معهم علاقات طويلة الأمد.
            </p>
            <p class="mb-8">
                هدفنا هو تحقيق أهدافك والعمل على حل المشاكل، وليس خلق مشاكل جديدة. نحن نعرف كيف نحقق رضا العملاء ونعمل بجد وذكاء لمساعدة عملائنا في تحقيق النتائج التي يريدونها.
            </p>
            <div class="flex gap-4 flex-wrap">
                <a href="{{ route('contact') }}" class="btn-attorney-primary">اتصل بنا</a>
                <a href="{{ route('services') }}" class="btn-attorney-secondary">خدماتنا</a>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="py-24" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
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
<section class="py-24" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <h2 class="section-title">آراء عملائنا</h2>
        <p class="section-subtitle">ماذا يقول عملاؤنا عن خدماتنا</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ratings as $rating)
                <div class="card-attorney p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="text-2xl">👤</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary">{{ $rating->client->name }}</h4>
                            <div class="flex gap-1 mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-lg {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @if($rating->comment)
                        <p class="text-gray-700 leading-relaxed mb-4">{{ $rating->comment }}</p>
                    @endif
                    <p class="text-sm text-gray-500">{{ $rating->created_at->format('Y-m-d') }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- About Preview -->
<section class="py-24 bg-section-light">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6 text-primary">من نحن</h2>
                <p class="mb-6 text-gray-600 text-lg leading-relaxed">
                    نحن شركة قانونية متخصصة في القانون التجاري والاستثمار الأجنبي. نقدم خدمات قانونية شاملة للشركات والأفراد.
                </p>
                <p class="mb-8 text-gray-600 text-lg leading-relaxed">
                    نركز على تقديم تمثيل قانوني متميز مع لمسة شخصية. لقد بنينا سمعتنا بشكل أساسي على توصيات عملائنا الراضين، الذين طورنا معهم علاقات طويلة الأمد.
                </p>
                <a href="{{ route('about') }}" class="btn-attorney-primary">اقرأ المزيد عنا</a>
            </div>
            <div class="card-attorney p-10">
                <div class="text-center">
                    <div class="text-7xl mb-6">⚖️</div>
                    <h3 class="text-2xl font-bold mb-4 text-primary">خبرة واسعة</h3>
                    <p class="text-gray-600 leading-relaxed">
                        سنوات من الخبرة في مختلف المجالات القانونية مع فريق من المحامين المتخصصين
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

