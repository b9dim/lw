@extends('layouts.client')

@section('title', 'تفاصيل القضية')

@section('content')
<!-- Header Actions -->
<div class="mb-8">
    <a href="{{ route('client.dashboard') }}" class="text-primary hover:text-accent font-semibold flex items-center gap-2 transition-colors duration-200 hover:underline inline-block">
        <span class="text-xl">←</span> 
        <span>العودة إلى لوحة التحكم</span>
    </a>
</div>

<!-- Case Info Card - Modern Creative Design -->
<div class="card-dashboard p-8 mb-8 relative overflow-hidden border-2 border-primary/20">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/15 to-accent/15 rounded-bl-full opacity-50"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-accent/15 to-primary/10 rounded-tr-full opacity-50"></div>
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent via-primary to-accent"></div>
    
    <div class="relative z-10">
        <div class="flex items-start justify-between mb-6 flex-wrap gap-4">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-4 mb-3">
                    <div class="icon-circle icon-circle-lg text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 4v15" />
                            <path d="M7 19h10" />
                            <path d="m5 10 3 6 3-6" />
                            <path d="m13 10 3 6 3-6" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-2xl md:text-3xl font-bold text-primary mb-1">تفاصيل القضية</h1>
                        <p class="text-gray-600 text-sm">
                            رقم القضية: 
                            <span class="font-mono font-bold text-accent bg-accent/15 px-2 py-0.5 rounded">{{ $case->case_number }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0">
                <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }} text-base px-5 py-2 shadow-sm">
                    {{ $case->status }}
                </span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-primary/30 transition-all duration-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 20h16" />
                            <path d="M6 20V10" />
                            <path d="M10 20V10" />
                            <path d="M14 20V10" />
                            <path d="M18 20V10" />
                            <path d="M12 4 4 9h16L12 4z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">المحكمة</p>
                </div>
                <p class="text-lg font-bold text-primary">{{ $case->court_name ?? 'غير محدد' }}</p>
            </div>
            
            <div class="bg-white p-5 rounded-lg border border-accent/30 shadow-sm hover:shadow-md hover:border-accent/50 transition-all duration-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle icon-circle-accent">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="9" r="3.2" />
                            <path d="M6 20c0-3.2 3-5.7 6-5.7s6 2.5 6 5.7" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">المحامي المكلف</p>
                </div>
                <p class="text-lg font-bold text-accent">{{ $case->lawyer->name ?? 'غير محدد' }}</p>
            </div>
            
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-primary/30 transition-all duration-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="4" y="6" width="16" height="13" rx="2" />
                            <path d="M8 3v3" />
                            <path d="M16 3v3" />
                            <path d="M4 11h16" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">تاريخ الإنشاء</p>
                </div>
                <p class="text-lg font-bold text-primary">{{ $case->created_at->format('Y-m-d') }}</p>
            </div>
        </div>

        @if($case->description)
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-1 h-6 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                    <p class="text-gray-700 font-semibold text-lg">الوصف</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border-r-4 border-primary">
                    <p class="text-gray-700 leading-relaxed text-lg">{{ $case->description }}</p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Timeline - Updates Section -->
<div class="card-dashboard p-8 mb-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
        <div>
            <h2 class="text-2xl font-bold text-primary">سجل التحديثات</h2>
            <p class="text-gray-500 text-sm mt-1">آخر التحديثات والمستجدات في قضيتك</p>
        </div>
    </div>
    
    @if($updates->count() > 0)
        <div class="space-y-4">
            @foreach($updates as $index => $update)
                <div class="timeline-item-updated">
                    <div class="timeline-dot-updated"></div>
                    <div class="timeline-content">
                        <div class="bg-gradient-to-br from-primary/5 via-accent/10 to-primary/5 rounded-lg p-5 border-r-4 border-primary shadow-md hover:shadow-lg transition-all">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <div class="flex items-center gap-3 flex-1">
                                    <div class="icon-circle icon-circle-sm icon-circle-solid flex-shrink-0">
                                        <span class="text-sm font-bold">{{ $updates->count() - $index }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                                            <span class="text-xs font-bold bg-primary text-white px-3 py-1 rounded-full shadow-md ring-1 ring-primary/30">تحديث</span>
                                            <h3 class="font-bold text-lg text-primary break-words">{{ $update->title }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="text-xs text-primary bg-white border border-primary px-3 py-1 rounded-full flex items-center gap-1 whitespace-nowrap font-medium">
                                        <span>🕐</span>
                                        <span>{{ $update->created_at->format('Y-m-d') }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-primary/20">
                                <div class="flex items-start gap-2">
                                    <div class="w-1 h-full bg-gradient-to-b from-primary to-accent rounded-full flex-shrink-0"></div>
                                    <p class="text-gray-800 leading-relaxed text-base pr-2 flex-1">{{ $update->detail }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 bg-gradient-to-br from-primary/5 to-accent/10 rounded-lg border border-primary/20">
            <div class="icon-circle icon-circle-lg icon-circle-accent mx-auto mb-4">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M9 12h6" />
                    <path d="M9 16h4" />
                    <path d="M12 3H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V9l-6-6z" />
                    <path d="M14 3v5h5" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-primary mb-2">لا توجد تحديثات حالياً</h3>
            <p class="text-gray-600">سيتم إضافة التحديثات والمستجدات هنا عند توفرها</p>
        </div>
    @endif
</div>

<!-- Inquiries Section -->
<div class="card-dashboard p-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-8 bg-gradient-to-b from-accent to-primary rounded-full"></div>
        <div>
            <h2 class="text-2xl font-bold text-primary">الاستفسارات</h2>
            <p class="text-gray-500 text-sm mt-1">تواصل مع المحامي المكلف بقضيتك</p>
        </div>
    </div>
    
    <!-- Inquiry Form -->
    <div class="bg-gradient-to-br from-accent/10 via-accent/5 to-accent/10 rounded-lg p-5 mb-8 border border-accent/30">
        <form method="POST" action="{{ force_https_route('client.cases.inquiries.store', $case->id) }}">
            @csrf
            <div class="flex items-center gap-2 mb-3">
                <div class="icon-circle icon-circle-sm icon-circle-accent">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                    </svg>
                </div>
                <label class="text-gray-700 font-semibold">أرسل استفساراً</label>
            </div>
            <textarea name="message" rows="4" class="form-input-attorney mb-3" 
                      placeholder="اكتب استفسارك هنا..." required></textarea>
            <button type="submit" class="btn-attorney-primary">
                إرسال الاستفسار
            </button>
        </form>
    </div>

    <!-- Inquiries List -->
    @if($inquiries->count() > 0)
        <div class="space-y-4">
            @foreach($inquiries as $inquiry)
                <!-- Client Inquiry -->
                <div class="bg-gradient-to-br from-accent/10 via-accent/5 to-accent/10 rounded-lg p-5 border-r-4 border-accent shadow-md hover:shadow-lg transition-all">
                    <div class="flex justify-between items-start mb-3 flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="icon-circle icon-circle-accent">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <span class="text-xs font-bold text-accent px-3 py-1 rounded-full shadow-sm border border-accent bg-white/80">استفسارك</span>
                                    <p class="font-bold text-lg text-primary">رسالتك</p>
                                </div>
                                <p class="text-xs text-primary flex items-center gap-1 mt-1 font-medium">
                                    <span>🕐</span>
                                    {{ $inquiry->created_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4 mb-3 border border-accent/30">
                        <p class="text-gray-800 leading-relaxed text-base">{{ $inquiry->message }}</p>
                    </div>
                    
                    @if($inquiry->reply)
                        <!-- Lawyer Reply -->
                        <div class="bg-gradient-to-br from-primary/10 via-primary/5 to-accent/10 rounded-lg p-5 border-r-4 border-primary shadow-md mt-3">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="icon-circle icon-circle-solid">
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 3 5 5v6c0 4.8 3.3 9 7 9s7-4.2 7-9V5l-7-2z" />
                                        <path d="m10 11 2 2 3-3" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                                        <span class="text-xs font-bold bg-primary text-white px-3 py-1 rounded-full shadow-md ring-1 ring-primary/30">رد المحامي</span>
                                        <p class="font-bold text-lg text-primary">الرد</p>
                                    </div>
                                    <p class="text-xs text-primary flex items-center gap-1 mt-1 font-medium">
                                        <span>🕐</span>
                                        {{ $inquiry->replied_at->format('Y-m-d H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-primary/20">
                                <div class="flex items-start gap-2">
                                    <div class="w-1 h-full bg-gradient-to-b from-primary to-accent rounded-full flex-shrink-0"></div>
                                    <p class="text-gray-800 leading-relaxed text-base pr-2 flex-1">{{ $inquiry->reply }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg p-3 border border-yellow-300 mt-3">
                            <p class="text-gray-700 text-sm flex items-center gap-2 font-semibold">
                                <span>⏳</span>
                                في انتظار الرد من المحامي...
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 bg-gradient-to-br from-accent/10 to-accent/5 rounded-lg border border-accent/30">
            <div class="icon-circle icon-circle-lg icon-circle-accent mx-auto mb-4">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-primary mb-2">لا توجد استفسارات حالياً</h3>
            <p class="text-gray-600">يمكنك إرسال استفسار من النموذج أعلاه</p>
        </div>
    @endif
</div>

@endsection

