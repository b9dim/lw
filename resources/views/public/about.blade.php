@extends('layouts.public')

@section('title', 'من نحن')

@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="max-w-4xl mx-auto">
            <h1 class="section-title">من نحن</h1>
            
            <div class="card-attorney p-10 mb-10">
                <h2 class="text-3xl font-bold mb-6 text-primary">شركة مسفر محمد العرجاني للمحاماة والاستشارات القانونية</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-4">
                    نحن شركة قانونية رائدة تأسست على مبادئ الاحترافية والتميز في تقديم الخدمات القانونية. 
                    نقدم خدماتنا لعملائنا من خلال فريق من المحامين ذوي الخبرة الواسعة في مختلف المجالات القانونية.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed mb-4">
                    تتميز شركتنا بالالتزام بتقديم أفضل الخدمات القانونية مع الحفاظ على أعلى معايير الجودة والاحترافية. 
                    نحن نؤمن بأن كل قضية فريدة وتستحق الاهتمام الكامل والجهد المتميز لتحقيق أفضل النتائج لعملائنا.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="card-attorney p-8">
                    <div class="text-5xl mb-6 text-center">🎯</div>
                    <h3 class="text-xl font-bold mb-4 text-primary text-center">رؤيتنا</h3>
                    <p class="text-gray-600 text-center">أن نكون الشركة القانونية الرائدة في تقديم الخدمات القانونية المتخصصة والاحترافية</p>
                </div>
                <div class="card-attorney p-8">
                    <div class="text-5xl mb-6 text-center">💼</div>
                    <h3 class="text-xl font-bold mb-4 text-primary text-center">مهمتنا</h3>
                    <p class="text-gray-600 text-center">تقديم خدمات قانونية متميزة تلبي احتياجات عملائنا وتحقق أهدافهم بكفاءة عالية</p>
                </div>
            </div>

            <div class="card-attorney p-10">
                <h2 class="text-2xl font-bold mb-8 text-primary">قيمنا</h2>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <span class="text-primary text-2xl ml-4 font-bold">✓</span>
                        <div>
                            <h4 class="font-bold mb-2 text-lg">الاحترافية</h4>
                            <p class="text-gray-600">نلتزم بأعلى معايير الاحترافية في جميع خدماتنا</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="text-primary text-2xl ml-4 font-bold">✓</span>
                        <div>
                            <h4 class="font-bold mb-2 text-lg">الشفافية</h4>
                            <p class="text-gray-600">نؤمن بالشفافية الكاملة في التعامل مع عملائنا</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="text-primary text-2xl ml-4 font-bold">✓</span>
                        <div>
                            <h4 class="font-bold mb-2 text-lg">الالتزام</h4>
                            <p class="text-gray-600">نلتزم بتحقيق أفضل النتائج لعملائنا في الوقت المحدد</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

