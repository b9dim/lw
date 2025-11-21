@extends('layouts.public')

@section('title', 'الرئيسية')

@section('content')
<!-- Hero Section - Matching almo.html design -->
<section class="elementor-section elementor-top-section elementor-section-height-full elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-items-middle" style="background: linear-gradient(135deg, #0B2F24 0%, #072017 50%, #000000 100%); min-height: 100vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="elementor-background-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg width=\"100\" height=\"100\" xmlns=\"http://www.w3.org/2000/svg\"><defs><pattern id=\"grid\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><path d=\"M 100 0 L 0 0 0 100\" fill=\"none\" stroke=\"rgba(26,71,42,0.03)\" stroke-width=\"1\"/></pattern></defs><rect width=\"100%\" height=\"100%\" fill=\"url(%23grid)\"/></svg>'); opacity: 0.5;"></div>
    
    <div class="elementor-container elementor-column-gap-default" style="position: relative; z-index: 1; width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="elementor-column elementor-col-100 elementor-top-column">
            <div class="elementor-widget-wrap elementor-element-populated" style="text-align: center; color: white;">
                <!-- Logo -->
                <div class="mb-8" style="margin-bottom: 2rem;">
                    <img src="{{ asset('images/logo.svg') }}" alt="شركة مسفر محمد العرجاني" style="max-width: 200px; height: auto; margin: 0 auto; display: block;" />
                </div>
                
                <!-- Heading -->
                <h1 class="elementor-heading-title" style="font-size: 3.5rem; font-weight: 800; color: white; margin-bottom: 2rem; line-height: 1.2;">
                    شركة مسفر محمد العرجاني
                </h1>
                
                <!-- WhatsApp Button -->
                <div class="ct-button-wrapper" style="margin-top: 2rem;">
                    <a href="https://wa.me/966549801099" class="btn btn-default" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 16px 32px; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 18px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);">
                        <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
                        <span>تواصل معنا</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section - من نحن -->
<section id="about" class="elementor-section elementor-top-section elementor-section-boxed elementor-section-height-default" style="padding: 80px 0; background: #ffffff;">
    <div class="elementor-container elementor-column-gap-default" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="elementor-column elementor-col-100">
            <div class="elementor-widget-wrap elementor-element-populated">
                <!-- Inner Section -->
                <section class="elementor-section elementor-inner-section elementor-section-content-middle" style="display: flex; align-items: center;">
                    <div class="elementor-container elementor-column-gap-extended" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                        <!-- Text Column -->
                        <div class="elementor-column elementor-col-50">
                            <div class="elementor-widget-wrap">
                                <!-- Heading -->
                                <div class="ct-heading" style="text-align: right; margin-bottom: 2rem;">
                                    <h3 class="item--title" style="font-size: 2.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1.5rem; position: relative; padding-bottom: 1rem;">
                                        <span class="sp-main">
                                            <i style="display: inline-block; width: 4px; height: 40px; background: linear-gradient(180deg, #1b3d6b 0%, #C8A848 100%); margin-left: 15px; vertical-align: middle;"></i>
                                            من نحن
                                        </span>
                                    </h3>
                                </div>
                                
                                <!-- Text Content -->
                                <div class="elementor-widget-text-editor" style="text-align: right; color: #333; line-height: 1.9; font-size: 18px;">
                                    <p style="margin-bottom: 1.5rem;">
                                        <strong>نحن شركة مسفر محمد العرجاني نضم نخبة من المحامين والمستشارين الأكفاء، تتجاوز خبراتنا مدة <span style="color: #000080;">(10) أعوام</span> في المملكة العربية السعودية.</strong>
                                    </p>
                                    <p style="margin-bottom: 1.5rem;">
                                        باشرنا خلال هذه المــدة عــدد ضــخــم مـــن القضــايــا، فــي كــافة أنــواع المنازعــات سواء: (تجــارية، حقــوقيــة، عماليــة، مصرفيــة وتمويليــة جزائيــة، أحــوال شخصــية، إداريــة)، كــما قمــنا بصيــاغــة ومراجعــة جميــع أنواع العقود اللازمة لتسيير الأعمــال التجاريــة والمهنيــة سواء: (عقــود بيع، إجــارة، شراكة مضــاربة أو عنــان، شــركات نظاميــة، امتيــاز تجــاري، عقــود عمل، تقبيل، مقاولة، توريد، أشغال عامة، وغيرها..).
                                    </p>
                                    <p>
                                        في شركة مسفر محمد العرجاني نمتلــك فريــق عمل متــكامل مكــون من أفضــل الكــوادر المختــارون بعناية شديدة، لتحقيق الغرض المبتغى المتمثل في تقديم خدمة قانونية مميزة وسريعة.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image Column -->
                        <div class="elementor-column elementor-col-50">
                            <div class="elementor-widget-wrap">
                                <div class="ct-banner1" style="position: relative;">
                                    <div class="ct-banner-imge" style="position: relative;">
                                        <img src="https://via.placeholder.com/272x408/1b3d6b/ffffff?text=شركة+مسفر+محمد+العرجاني" alt="شركة مسفر محمد العرجاني" style="width: 100%; max-width: 272px; height: auto; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);" />
                                        <h3 class="ct-banner-title" style="position: absolute; bottom: 20px; right: 20px; background: rgba(27, 61, 107, 0.95); color: white; padding: 12px 24px; border-radius: 8px; font-size: 1.2rem; font-weight: 600; margin: 0;">
                                            أكثر من 10 أعوام خبرة
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<!-- Team Sections - أقسام فريق العمل -->
<section id="teams" class="elementor-section elementor-top-section elementor-section-stretched elementor-section-boxed" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="elementor-container elementor-column-gap-extended" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Section Title -->
        <div class="elementor-column elementor-col-100" style="margin-bottom: 4rem;">
            <div class="elementor-widget-wrap">
                <div class="ct-heading" style="text-align: center;">
                    <h3 class="item--title" style="font-size: 2.5rem; font-weight: 700; color: #1b3d6b; position: relative; padding-bottom: 1rem;">
                        <span class="sp-main">
                            <i style="display: inline-block; width: 4px; height: 40px; background: linear-gradient(180deg, #1b3d6b 0%, #C8A848 100%); margin-left: 15px; vertical-align: middle;"></i>
                            أقسام فريق العمل
                        </span>
                    </h3>
                </div>
            </div>
        </div>
        
        <!-- Team Cards -->
        <div class="elementor-column elementor-col-100">
            <div class="elementor-widget-wrap" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <!-- القسم الإداري -->
                <div class="ct-fancy-box ct-fancy-box-layout6" style="background: white; padding: 40px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="item--icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #1b3d6b 0%, #C8A848 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                        <i class="fas fa-users-cog" style="font-size: 40px; color: white;"></i>
                    </div>
                    <div class="item--holder">
                        <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1rem;">
                            القسم الإداري
                        </h3>
                        <div class="item--description" style="color: #666; line-height: 1.8; font-size: 16px;">
                            هو المســــــؤول عـــن التواصــــــل المبــــاشـــر والسريـــــع مــع الشــــركات التــي نقــدم لـــها خدماتنا، فيستقبل كافــة الأعمال القانونــية، الاستشارات التي ترسلها الشركة المتعاقد معها، ليقوم باستكمال النواقص فيها (إن لزم)، ومن ثم؛ تحويلها على القسم الفني أو الإجــرائـي -بــحسب الأحــــوال- لــيقم بــدوره بتقديم اللازم فيها.
                        </div>
                    </div>
                </div>
                
                <!-- القسم الفني -->
                <div class="ct-fancy-box ct-fancy-box-layout6" style="background: white; padding: 40px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="item--icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #1b3d6b 0%, #C8A848 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                        <i class="fas fa-gavel" style="font-size: 40px; color: white;"></i>
                    </div>
                    <div class="item--holder">
                        <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1rem;">
                            القسم الفني
                        </h3>
                        <div class="item--description" style="color: #666; line-height: 1.8; font-size: 16px;">
                            يتكون من مستشارين قانونيين، خبراتهم تتــرواح مـا بيـن (5 سنوات الى 10 سنوات) فـــي الممـــلكة العربيــة السعــوديــة، وهــم المســؤولــون عـن إنجــاز كــافة المعـــاملات المــحولــة مــن قبــل القســـــم الإداري، التــي تتســـم بالطابــع الاستشــاري غير الإجرائي، كصيـــاغة العقــــود ومــراجــعتها، وتقــــديـــم اســتشــارة مكتــوبة عن إشكالية أو تساؤل مـعين، وكتابة المذكرات القانونية، وغيرها...
                        </div>
                    </div>
                </div>
                
                <!-- القسم الإجرائي -->
                <div class="ct-fancy-box ct-fancy-box-layout6" style="background: white; padding: 40px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="item--icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #1b3d6b 0%, #C8A848 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                        <i class="fas fa-balance-scale" style="font-size: 40px; color: white;"></i>
                    </div>
                    <div class="item--holder">
                        <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1rem;">
                            القسم الإجرائي
                        </h3>
                        <div class="item--description" style="color: #666; line-height: 1.8; font-size: 16px;">
                            يتــــكون مــــن مــحــاميــن بالرياض وجدة والمدينة، خبراتهم تتراوح ما بين (3 سنوات إلى 10 سنوات)، وهم المسؤولون عن مباشرة مــهام الترافــع والمدافعة في كافة القضايا والمنازعـات أمام المحاكم واللجان القضائية وشــبه القضــائية، وكــذلك تولــي التحقيقات مــع الـــعاملــين بالشــركة المتعــاقد معــها، وتــمثيل الأخيـرة في العقود التي تبرمها مع الغير.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section - خدماتنا -->
<section id="serv" class="elementor-section elementor-top-section elementor-section-boxed" style="padding: 80px 0; background: white;">
    <div class="elementor-container elementor-column-gap-default" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Section Title -->
        <div class="elementor-column elementor-col-100" style="margin-bottom: 4rem;">
            <div class="elementor-widget-wrap">
                <div class="ct-heading" style="text-align: center;">
                    <h3 class="item--title" style="font-size: 2.5rem; font-weight: 700; color: #1b3d6b; position: relative; padding-bottom: 1rem;">
                        <span class="sp-main">
                            <i style="display: inline-block; width: 4px; height: 40px; background: linear-gradient(180deg, #1b3d6b 0%, #C8A848 100%); margin-left: 15px; vertical-align: middle;"></i>
                            خدماتنا
                        </span>
                    </h3>
                </div>
            </div>
        </div>
        
        <!-- Services Grid -->
        <div class="elementor-column elementor-col-100">
            <div class="ct-grid ct-service-grid2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <!-- Service 1: كتابة المذكرات واللوائح -->
                <div class="grid-item" style="position: relative; overflow: hidden; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="grid-item-inner" style="position: relative;">
                        <div class="item--featured" style="position: relative; overflow: hidden; height: 250px;">
                            <img src="https://via.placeholder.com/1024x576/1b3d6b/ffffff?text=كتابة+المذكرات+واللوائح" alt="كتابة المذكرات واللوائح" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" />
                        </div>
                        <div class="item--meta" style="padding: 24px; background: white;">
                            <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1rem;">
                                كتابة المذكرات واللوائح
                            </h3>
                            <div class="item--holder" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(27, 61, 107, 0.95); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; padding: 24px;">
                                <div class="item--holder-inner" style="text-align: center; color: white;">
                                    <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: white;">
                                        كتابة المذكرات واللوائح
                                    </h3>
                                    <div class="entry-readmore">
                                        <a href="{{ route('services') }}" class="btn btn-default" style="display: inline-block; padding: 12px 24px; background: #C8A848; color: #1b3d6b; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                            اكتشف الخدمات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Service 2: خدمات خاصة بالشركات -->
                <div class="grid-item" style="position: relative; overflow: hidden; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="grid-item-inner" style="position: relative;">
                        <div class="item--featured" style="position: relative; overflow: hidden; height: 250px;">
                            <img src="https://via.placeholder.com/1024x576/1b3d6b/ffffff?text=خدمات+خاصة+بالشركات" alt="خدمات خاصة بالشركات" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" />
                        </div>
                        <div class="item--meta" style="padding: 24px; background: white;">
                            <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1rem;">
                                خدمات خاصة بالشركات
                            </h3>
                            <div class="item--holder" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(27, 61, 107, 0.95); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; padding: 24px;">
                                <div class="item--holder-inner" style="text-align: center; color: white;">
                                    <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: white;">
                                        خدمات خاصة بالشركات
                                    </h3>
                                    <div class="entry-readmore">
                                        <a href="{{ route('services') }}" class="btn btn-default" style="display: inline-block; padding: 12px 24px; background: #C8A848; color: #1b3d6b; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                            اكتشف الخدمات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Service 3: خدمات خاصة بالعملاء أمام المحاكم القضائية -->
                <div class="grid-item" style="position: relative; overflow: hidden; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="grid-item-inner" style="position: relative;">
                        <div class="item--featured" style="position: relative; overflow: hidden; height: 250px;">
                            <img src="https://via.placeholder.com/1024x576/1b3d6b/ffffff?text=خدمات+خاصة+بالعملاء+أمام+المحاكم" alt="خدمات خاصة بالعملاء أمام المحاكم القضائية" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" />
                        </div>
                        <div class="item--meta" style="padding: 24px; background: white;">
                            <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1rem;">
                                خدمات خاصة بالعملاء أمام المحاكم القضائية
                            </h3>
                            <div class="item--holder" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(27, 61, 107, 0.95); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; padding: 24px;">
                                <div class="item--holder-inner" style="text-align: center; color: white;">
                                    <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: white;">
                                        خدمات خاصة بالعملاء أمام المحاكم القضائية
                                    </h3>
                                    <div class="entry-readmore">
                                        <a href="{{ route('services') }}" class="btn btn-default" style="display: inline-block; padding: 12px 24px; background: #C8A848; color: #1b3d6b; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                            اكتشف الخدمات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Service 4: قسم خاص يعاون المحامين -->
                <div class="grid-item" style="position: relative; overflow: hidden; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="grid-item-inner" style="position: relative;">
                        <div class="item--featured" style="position: relative; overflow: hidden; height: 250px;">
                            <img src="https://via.placeholder.com/1024x576/1b3d6b/ffffff?text=قسم+خاص+يعاون+المحامين" alt="قسم خاص يعاون المحامين" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" />
                        </div>
                        <div class="item--meta" style="padding: 24px; background: white;">
                            <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; color: #1b3d6b; margin-bottom: 1rem;">
                                قسم خاص يعاون المحامين في القضايا وصياغة المذكرات
                            </h3>
                            <div class="item--holder" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(27, 61, 107, 0.95); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; padding: 24px;">
                                <div class="item--holder-inner" style="text-align: center; color: white;">
                                    <h3 class="item--title" style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: white;">
                                        قسم خاص يعاون المحامين في القضايا وصياغة المذكرات
                                    </h3>
                                    <div class="entry-readmore">
                                        <a href="{{ route('services') }}" class="btn btn-default" style="display: inline-block; padding: 12px 24px; background: #C8A848; color: #1b3d6b; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                            اكتشف الخدمات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section - ماذا قال عملاؤنا -->
@if($ratings->count() > 0)
<section class="elementor-section elementor-top-section elementor-section-boxed" style="padding: 80px 0; background: linear-gradient(135deg, #1b3d6b 0%, #0d2440 100%);">
    <div class="elementor-container elementor-column-gap-default" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Section Title -->
        <div class="elementor-column elementor-col-100" style="margin-bottom: 4rem; text-align: center;">
            <div class="elementor-widget-wrap">
                <div class="elementor-icon-wrapper" style="margin-bottom: 1.5rem;">
                    <div class="elementor-icon" style="width: 80px; height: 80px; background: rgba(200, 168, 72, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-envelope-open-text" style="font-size: 40px; color: #C8A848;"></i>
                    </div>
                </div>
                <div class="ct-heading">
                    <h2 class="item--title" style="font-size: 2.5rem; font-weight: 700; color: white; position: relative; padding-bottom: 1rem;">
                        <span class="sp-main">
                            مـــاذا قـــال عـمــلائــنــا ؟
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        
        <!-- Ratings Grid -->
        <div class="elementor-column elementor-col-100">
            <div class="elementor-widget-wrap" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                @foreach($ratings as $rating)
                    <div class="bg-white rounded-3xl shadow-xl p-8 relative overflow-hidden" style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); position: relative;">
                        <span class="absolute text-[120px] opacity-10 top-0 right-5" style="position: absolute; font-size: 120px; opacity: 0.1; top: 0; right: 20px; color: #1b3d6b;">"</span>
                        <div class="relative z-10" style="position: relative; z-index: 1;">
                            <h3 class="font-bold text-xl mb-1" style="font-size: 1.25rem; font-weight: 700; color: #1b3d6b; margin-bottom: 0.5rem;">
                                {{ $rating->client->name }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-5" style="font-size: 0.875rem; color: #666; margin-bottom: 1.25rem;">عميل</p>
                            @if($rating->comment)
                                <p class="leading-relaxed text-gray-700 text-lg mb-5" style="line-height: 1.8; color: #333; font-size: 1.125rem; margin-bottom: 1.25rem;">
                                    {{ $rating->comment }}
                                </p>
                            @endif
                            <div class="flex gap-1 text-yellow-400 text-xl" style="display: flex; gap: 0.25rem; color: #fbbf24; font-size: 1.25rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $rating->rating ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<style>
/* Hover Effects */
.grid-item:hover {
    transform: translateY(-5px);
}

.grid-item:hover .item--holder {
    opacity: 1 !important;
}

.grid-item:hover .item--featured img {
    transform: scale(1.1);
}

.ct-fancy-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .elementor-container {
        padding: 0 15px !important;
    }
    
    h1.elementor-heading-title {
        font-size: 2rem !important;
    }
    
    .ct-heading .item--title {
        font-size: 1.75rem !important;
    }
    
    .elementor-container[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
}
</style>
@endsection
