@extends('layouts.admin')

@section('title', 'تفاصيل الرسالة')

@section('content')
<!-- Header Actions -->
<div class="mb-8 lg:mb-12">
    <a href="{{ route('admin.contact-messages.index') }}" class="text-primary hover:text-accent font-semibold flex items-center gap-2 transition-colors duration-200 hover:underline inline-block lg:text-lg">
        <span class="text-xl lg:text-2xl">←</span> 
        <span>العودة إلى قائمة الرسائل</span>
    </a>
</div>

<!-- Message Details Card -->
<div class="card-dashboard p-8 lg:p-10 mb-8 lg:mb-12 relative overflow-hidden border-2 border-primary/20">
    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/15 to-accent/15 rounded-bl-full opacity-50"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-accent/15 to-primary/10 rounded-tr-full opacity-50"></div>
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent via-primary to-accent"></div>
    
    <div class="relative z-10">
        <div class="flex items-start justify-between mb-6 flex-wrap gap-4">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-4 mb-3">
                    <div class="icon-circle icon-circle-lg text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary mb-1 lg:mb-2">تفاصيل الرسالة</h1>
                        <p class="text-gray-600 text-sm lg:text-base">
                            {{ $contactMessage->subject }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                @if($contactMessage->read)
                    <span class="badge-dashboard badge-completed text-base px-5 py-2 shadow-sm">مقروءة</span>
                @else
                    <span class="badge-dashboard badge-processing text-base px-5 py-2 shadow-sm">جديدة</span>
                @endif
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="9" r="3.2" />
                            <path d="M6 20c0-3.2 3-5.7 6-5.7s6 2.5 6 5.7" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">الاسم</p>
                </div>
                <p class="text-lg font-bold text-primary">{{ $contactMessage->name }}</p>
            </div>
            
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">البريد الإلكتروني</p>
                </div>
                <p class="text-lg font-bold text-primary break-all">{{ $contactMessage->email }}</p>
            </div>
            
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="4" y="6" width="16" height="13" rx="2" />
                            <path d="M8 3v3" />
                            <path d="M16 3v3" />
                            <path d="M4 11h16" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">تاريخ الإرسال</p>
                </div>
                <p class="text-lg font-bold text-primary">{{ $contactMessage->created_at->format('Y-m-d H:i') }}</p>
            </div>
            
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-circle text-primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">الحالة</p>
                </div>
                <p class="text-lg font-bold text-primary">
                    @if($contactMessage->read)
                        مقروءة
                    @else
                        غير مقروءة
                    @endif
                </p>
            </div>
        </div>

        <div class="mt-8 lg:mt-10 pt-6 lg:pt-8 border-t border-gray-200">
            <div class="flex items-center gap-3 lg:gap-4 mb-4 lg:mb-6">
                <div class="w-1 h-6 lg:h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <p class="text-gray-700 font-semibold text-lg lg:text-xl">الموضوع</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6 lg:p-8 border-r-4 border-primary">
                <p class="text-gray-700 leading-relaxed text-lg lg:text-xl">{{ $contactMessage->subject }}</p>
            </div>
        </div>

        <div class="mt-8 lg:mt-10 pt-6 lg:pt-8 border-t border-gray-200">
            <div class="flex items-center gap-3 lg:gap-4 mb-4 lg:mb-6">
                <div class="w-1 h-6 lg:h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <p class="text-gray-700 font-semibold text-lg lg:text-xl">الرسالة</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6 lg:p-8 border-r-4 border-primary">
                <p class="text-gray-700 leading-relaxed text-lg lg:text-xl whitespace-pre-wrap">{{ $contactMessage->message }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Actions Card -->
<div class="card-dashboard p-8 lg:p-10">
    <div class="flex items-center gap-3 lg:gap-4 mb-6 lg:mb-8">
        <div class="w-1 h-8 lg:h-10 bg-gradient-to-b from-primary to-accent rounded-full"></div>
        <div>
            <h2 class="text-2xl lg:text-3xl font-bold text-primary">الإجراءات</h2>
        </div>
    </div>
    
    <div class="flex gap-4 flex-wrap">
        @if($contactMessage->read)
            <form method="POST" action="{{ force_https_route('admin.contact-messages.mark-unread', $contactMessage->id) }}" class="inline">
                @csrf
                <button type="submit" class="btn-attorney-secondary">تحديد كغير مقروءة</button>
            </form>
        @else
            <form method="POST" action="{{ force_https_route('admin.contact-messages.mark-read', $contactMessage->id) }}" class="inline">
                @csrf
                <button type="submit" class="btn-attorney-secondary">تحديد كمقروءة</button>
            </form>
        @endif
        
        <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}" 
           class="btn-attorney-primary">الرد عبر البريد الإلكتروني</a>
        
        <form method="POST" action="{{ force_https_route('admin.contact-messages.destroy', $contactMessage->id) }}" 
              class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold shadow-sm hover:shadow-md">حذف الرسالة</button>
        </form>
    </div>
</div>
@endsection

