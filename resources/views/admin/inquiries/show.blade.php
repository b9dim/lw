@extends('layouts.admin')

@section('title', 'تفاصيل الاستفسار')

@section('content')
<!-- Header Actions -->
<div class="mb-8">
    <a href="{{ route('admin.inquiries.index') }}" class="text-primary hover:text-accent font-semibold flex items-center gap-2 transition-colors duration-200 hover:underline inline-block">
        <span class="text-xl">←</span> 
        <span>العودة إلى قائمة الاستفسارات</span>
    </a>
</div>

<!-- Case Info Card -->
<div class="card-dashboard p-8 mb-8 relative overflow-hidden border-2 border-primary/20">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/15 to-accent/15 rounded-bl-full opacity-50"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-accent/15 to-primary/10 rounded-tr-full opacity-50"></div>
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent via-primary to-accent"></div>
    
    <div class="relative z-10">
        <div class="flex items-center gap-4 mb-6">
            <div class="icon-circle icon-circle-lg icon-circle-accent flex-shrink-0">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl md:text-3xl font-bold text-primary mb-1">تفاصيل الاستفسار</h1>
                <p class="text-gray-600 text-sm">
                    رقم القضية: 
                    <span class="font-mono font-bold text-accent bg-accent/15 px-2 py-0.5 rounded">{{ $inquiry->case->case_number }}</span>
                </p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-primary/30 transition-all duration-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="9" r="3.2" />
                            <path d="M6 20c0-3.2 3-5.7 6-5.7s6 2.5 6 5.7" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">العميل</p>
                </div>
                <p class="text-lg font-bold text-primary">{{ $inquiry->client->name }}</p>
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
                    <p class="text-gray-700 font-semibold">تاريخ الاستفسار</p>
                </div>
                <p class="text-lg font-bold text-primary">{{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Linked Case Card -->
<div class="card-dashboard p-8 mb-8 border border-primary/15 shadow-sm hover:shadow-md transition relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary via-accent to-primary"></div>
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
        <div>
            <p class="text-sm text-primary font-semibold">القضية المرتبطة</p>
            <h2 class="text-2xl font-bold text-gray-900">تفاصيل القضية</h2>
        </div>
        <span class="ml-auto badge-dashboard badge-{{ str_replace(' ', '-', strtolower($inquiry->case->status)) }} text-sm px-4 py-2">
            {{ $inquiry->case->status }}
        </span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <p class="text-gray-500 text-sm mb-1">المحكمة</p>
            <p class="text-gray-900 font-semibold">{{ $inquiry->case->court_name ?? 'غير محدد' }}</p>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <p class="text-gray-500 text-sm mb-1">المحامي المكلف</p>
            <p class="text-gray-900 font-semibold">{{ $inquiry->case->lawyer->name ?? 'غير محدد' }}</p>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <p class="text-gray-500 text-sm mb-1">تاريخ إنشاء القضية</p>
            <p class="text-gray-900 font-semibold">{{ $inquiry->case->created_at->format('Y-m-d') }}</p>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <p class="text-gray-500 text-sm mb-1">آخر تحديث</p>
            <p class="text-gray-900 font-semibold">{{ optional($inquiry->case->updates->last())->created_at ? $inquiry->case->updates->last()->created_at->format('Y-m-d') : 'غير متوفر' }}</p>
        </div>
    </div>
    @if($inquiry->case->description)
        <div class="mt-6 bg-gray-50 border-r-4 border-primary rounded-xl p-5">
            <p class="text-sm text-gray-500 font-semibold mb-2">وصف القضية</p>
            <p class="text-gray-700 leading-relaxed">{{ $inquiry->case->description }}</p>
        </div>
    @endif
</div>

<!-- Inquiry Section -->
<div class="card-dashboard p-8 mb-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-8 bg-gradient-to-b from-accent to-primary rounded-full"></div>
        <div>
            <h2 class="text-2xl font-bold text-primary">الاستفسار</h2>
            <p class="text-gray-500 text-sm mt-1">استفسار العميل</p>
        </div>
    </div>
    
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
                        <span class="text-xs font-bold text-accent px-3 py-1 rounded-full shadow-sm border border-accent bg-white/80">استفسار العميل</span>
                        <p class="font-bold text-lg text-primary">رسالة العميل</p>
                    </div>
                    <p class="text-xs text-primary flex items-center gap-1 mt-1 font-medium">
                        <span>🕐</span>
                        {{ $inquiry->created_at->format('Y-m-d H:i') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 border border-accent/30">
            <p class="text-gray-800 leading-relaxed text-base">{{ $inquiry->message }}</p>
        </div>
    </div>
</div>

@if($inquiry->reply)
    <!-- Reply Section -->
    <div class="card-dashboard p-8 mb-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
            <div>
                <h2 class="text-2xl font-bold text-primary">الرد</h2>
                <p class="text-gray-500 text-sm mt-1">رد المحامي على الاستفسار</p>
            </div>
        </div>
        
        <!-- Lawyer Reply -->
        <div class="bg-gradient-to-br from-primary/10 via-primary/5 to-accent/10 rounded-lg p-5 border-r-4 border-primary shadow-md">
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
    </div>
@else
    <!-- Reply Form Section -->
    <div class="card-dashboard p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
            <div>
                <h2 class="text-2xl font-bold text-primary">الرد على الاستفسار</h2>
                <p class="text-gray-500 text-sm mt-1">اكتب ردك على استفسار العميل</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.inquiries.reply', $inquiry->id) }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">اكتب ردك <span class="text-red-500">*</span></label>
                <textarea name="reply" rows="6" class="form-input-attorney" 
                          placeholder="اكتب ردك هنا..." required></textarea>
            </div>
            <button type="submit" class="btn-attorney-primary">إرسال الرد</button>
        </form>
    </div>
@endif

@endsection
