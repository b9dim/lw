@extends('layouts.client')

@section('title', 'لوحة العميل')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-primary mb-2">مرحباً، {{ auth()->guard('client')->user()->name }}</h1>
    <p class="text-gray-600 text-lg">تابع قضاياك واستفساراتك من هنا</p>
</div>

<!-- Stats Cards -->
<div class="mb-8">
    <!-- Mobile: Horizontal Scroll -->
    <div class="md:hidden overflow-x-auto pb-2 -mx-4 px-4">
        <div class="flex gap-3 min-w-max">
            <div class="card-dashboard flex-shrink-0 w-[200px] p-4">
                <div class="flex flex-col">
                    <p class="stat-label text-xs mb-1">إجمالي القضايا</p>
                    <p class="stat-number text-primary text-2xl">{{ $cases->count() }}</p>
                    <div class="text-3xl opacity-20 mt-2">⚖️</div>
                </div>
            </div>
            <div class="card-dashboard flex-shrink-0 w-[200px] p-4">
                <div class="flex flex-col">
                    <p class="stat-label text-xs mb-1">قضايا قيد المعالجة</p>
                    <p class="stat-number text-xl" style="color: #0066cc;">
                        {{ $cases->where('status', 'قيد المعالجة')->count() }}
                    </p>
                    <div class="text-3xl opacity-20 mt-2">📋</div>
                </div>
            </div>
            <div class="card-dashboard flex-shrink-0 w-[200px] p-4">
                <div class="flex flex-col">
                    <p class="stat-label text-xs mb-1">قضايا قيد المحاكمة</p>
                    <p class="stat-number text-xl" style="color: #7c3aed;">
                        {{ $cases->where('status', 'قيد المحاكمة')->count() }}
                    </p>
                    <div class="text-3xl opacity-20 mt-2">🏛️</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Desktop: Grid -->
    <div class="hidden md:grid grid-cols-3 gap-6">
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">إجمالي القضايا</p>
                    <p class="stat-number text-primary">{{ $cases->count() }}</p>
                </div>
                <div class="text-5xl opacity-20">⚖️</div>
            </div>
        </div>
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">قضايا قيد المعالجة</p>
                    <p class="stat-number" style="color: #0066cc;">
                        {{ $cases->where('status', 'قيد المعالجة')->count() }}
                    </p>
                </div>
                <div class="text-5xl opacity-20">📋</div>
            </div>
        </div>
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">قضايا قيد المحاكمة</p>
                    <p class="stat-number" style="color: #7c3aed;">
                        {{ $cases->where('status', 'قيد المحاكمة')->count() }}
                    </p>
                </div>
                <div class="text-5xl opacity-20">🏛️</div>
            </div>
        </div>
    </div>
</div>

<!-- Cases List -->
<div class="card-attorney p-4 md:p-8 mb-8">
    <h2 class="text-2xl font-bold text-primary mb-6">قضاياي</h2>
    
    @if($cases->count() > 0)
        @php
            $statusBadgePalette = [
                'قيد المعالجة' => 'bg-[#DDF3EA] text-[#2B8A4A]',
                'قيد المحاكمة' => 'bg-[#DBEAFE] text-[#1E40AF]',
                'مكتملة' => 'bg-[#D1FAE5] text-[#065F46]',
                'منتهية' => 'bg-[#F1F5F9] text-[#475569]',
                'مغلقة' => 'bg-[#F1F5F9] text-[#475569]',
                'معلقة' => 'bg-[#FEF3C7] text-[#92400E]',
                'ملغاة' => 'bg-[#FEE2E2] text-[#991B1B]',
            ];
            // فصل القضايا إلى نشطة ومنتهية
            $activeCases = $cases->where('status', '!=', 'منتهية');
            $finishedCases = $cases->where('status', 'منتهية');
        @endphp
        
        @if($activeCases->count() > 0)
        <!-- Desktop Table View (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto mb-6">
            <div class="min-w-[700px] overflow-hidden rounded-[28px] border border-slate-200/70 bg-white shadow-[0_30px_60px_rgba(15,23,42,0.08)]">
                <table class="min-w-full text-right text-sm text-slate-600">
                    <thead class="bg-slate-50">
                        <tr class="text-[0.72rem] font-semibold uppercase tracking-[0.25em] text-slate-500">
                            <th class="px-6 py-4 text-right first:rounded-tl-[28px] last:rounded-tr-[28px]">رقم القضية</th>
                            <th class="px-6 py-4 text-right">المحكمة</th>
                            <th class="px-6 py-4 text-right">الحالة</th>
                            <th class="px-6 py-4 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($activeCases as $case)
                            @php
                                $badgeClass = $statusBadgePalette[$case->status] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <tr class="js-clickable-row transition-all duration-200 hover:bg-white hover:shadow-[0_12px_35px_rgba(15,23,42,0.08)] hover:-translate-y-0.5 odd:bg-white even:bg-slate-50/60" data-row-href="{{ route('client.cases.show', $case->id) }}" tabindex="0" role="link" aria-label="عرض تفاصيل القضية رقم {{ $case->case_number }}">
                                <td class="px-6 py-4 align-middle">
                                    <div class="inline-flex items-center gap-2 rounded-2xl border border-[#E5E7EB] bg-white/80 px-4 py-2 font-semibold text-slate-900 shadow-sm">
                                        <span class="text-[10px] uppercase tracking-[0.4em] text-slate-400">قضية</span>
                                        <span class="font-mono text-base text-slate-900">{{ $case->case_number }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm font-medium text-slate-900">{{ $case->court_name ?? 'غير محدد' }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex flex-col gap-2 text-right">
                                        <span class="inline-flex w-max items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm {{ $badgeClass }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $case->status }}
                                        </span>
                                        <div class="case-last-update inline-flex items-center gap-2 rounded-2xl bg-white/60 px-3 py-2 text-[11px] font-medium" style="color: #B8860B;">
                                            <svg viewBox="0 0 24 24" class="h-4 w-4" style="color: #B8860B;" aria-hidden="true">
                                                <circle cx="12" cy="12" r="8.5" fill="none" stroke="currentColor" stroke-width="1.2"></circle>
                                                <path d="M12 8v4.2l2.8 1.6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.2"></path>
                                            </svg>
                                            <span>{{ $case->last_update_text ?? 'لا يوجد تحديث مضاف بعد' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle" data-row-link-ignore>
                                    <a href="{{ route('client.cases.show', $case->id) }}" class="inline-flex items-center gap-2 rounded-2xl border border-transparent bg-gradient-to-l from-primary to-accent px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
                                        <span>عرض التفاصيل</span>
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 18l6-6-6-6" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if($activeCases->count() > 0)
        <!-- Mobile Card View (visible only on mobile) -->
        <div class="md:hidden space-y-4 mb-6">
            @foreach($activeCases as $case)
                @php
                    $badgeClass = $statusBadgePalette[$case->status] ?? 'bg-gray-100 text-gray-600';
                @endphp
                <div class="relative overflow-hidden rounded-[24px] bg-[#F7F8F9] p-5 shadow-[0_25px_60px_rgba(15,23,42,0.08)] ring-1 ring-white/60 transition-shadow duration-200 hover:shadow-[0_30px_70px_rgba(15,23,42,0.12)] js-clickable-row"
                     data-row-href="{{ route('client.cases.show', $case->id) }}"
                     tabindex="0"
                     role="link"
                     aria-label="عرض تفاصيل القضية رقم {{ $case->case_number }}">
                    <div class="pointer-events-none absolute inset-0">
                        <div class="absolute -left-10 -top-10 h-32 w-32 rounded-full bg-white/40 blur-2xl"></div>
                        <div class="absolute bottom-0 right-0 h-28 w-28 rounded-tl-full bg-gradient-to-br from-primary/10 to-transparent"></div>
                    </div>
                    <div class="relative z-10 space-y-5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <p class="mb-2 text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400">قضية</p>
                                <div class="inline-flex items-center rounded-2xl border border-[#E5E7EB] bg-white/80 px-4 py-2 text-sm font-semibold text-slate-900 shadow-inner">
                                    <span class="font-mono text-base text-slate-900">{{ $case->case_number }}</span>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full px-4 py-1 text-xs font-semibold {{ $badgeClass }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $case->status }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">المحكمة</p>
                            <p class="text-sm font-medium text-slate-900">{{ $case->court_name ?? 'غير محدد' }}</p>
                        </div>
                        <div class="case-last-update flex items-center gap-3 rounded-2xl border border-white/50 bg-white/40 px-4 py-3 backdrop-blur-md">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white/80 shadow-inner">
                                <svg class="h-[14px] w-[14px]" style="color: #B8860B;" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <circle cx="12" cy="12" r="8.5" stroke-width="1.2"></circle>
                                    <path d="M12 8v3.8l2.4 1.4" stroke-linecap="round" stroke-width="1.2"></path>
                                </svg>
                            </div>
                            <div class="flex-1 text-right">
                                <p class="text-[11px] font-semibold text-slate-500">آخر تحديث</p>
                                <p class="text-xs leading-relaxed" style="color: #B8860B; font-weight: 600;">{{ $case->last_update_text ?? 'لا يوجد تحديث مضاف بعد' }}</p>
                            </div>
                        </div>
                        <div class="border-t border-slate-200/80 pt-4" data-row-link-ignore>
                            <a href="{{ route('client.cases.show', $case->id) }}" 
                               class="flex items-center justify-between text-sm font-semibold text-primary transition-colors hover:text-accent"
                               data-row-link-ignore>
                                <span>عرض التفاصيل</span>
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18l6-6-6-6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        
        @if($finishedCases->count() > 0)
        <!-- Finished Cases Section -->
        <div class="mt-8 pt-6 border-t border-slate-200">
            <h3 class="text-xl font-bold text-slate-600 mb-4">القضايا المنتهية</h3>
            
            <!-- Desktop Table View for Finished Cases -->
            <div class="hidden md:block overflow-x-auto mb-4">
                <div class="min-w-[700px] overflow-hidden rounded-[28px] border border-slate-200/50 bg-slate-50/50 shadow-sm">
                    <table class="min-w-full text-right text-sm text-slate-600">
                        <thead class="bg-slate-100/50">
                            <tr class="text-[0.72rem] font-semibold uppercase tracking-[0.25em] text-slate-400">
                                <th class="px-6 py-4 text-right first:rounded-tl-[28px] last:rounded-tr-[28px]">رقم القضية</th>
                                <th class="px-6 py-4 text-right">المحكمة</th>
                                <th class="px-6 py-4 text-right">الحالة</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($finishedCases as $case)
                                <tr class="opacity-75">
                                    <td class="px-6 py-4 align-middle">
                                        <div class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white/60 px-4 py-2 font-semibold text-slate-600">
                                            <span class="text-[10px] uppercase tracking-[0.4em] text-slate-400">قضية</span>
                                            <span class="font-mono text-base text-slate-600">{{ $case->case_number }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        <p class="text-sm font-medium text-slate-600">{{ $case->court_name ?? 'غير محدد' }}</p>
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold bg-slate-100 text-slate-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $case->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Mobile Card View for Finished Cases -->
            <div class="md:hidden space-y-3">
                @foreach($finishedCases as $case)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 opacity-75">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-[11px] text-slate-400 mb-1">قضية</p>
                                <div class="inline-flex items-center rounded-2xl border border-slate-200 bg-white/60 px-3 py-1.5 text-sm font-semibold text-slate-600">
                                    <span class="font-mono text-sm">{{ $case->case_number }}</span>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-slate-100 text-slate-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $case->status }}
                            </span>
                        </div>
                        <div class="mt-3">
                            <p class="text-xs text-slate-400 mb-1">المحكمة</p>
                            <p class="text-sm text-slate-600">{{ $case->court_name ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📂</div>
            <p class="text-gray-600 text-lg">لا توجد قضايا مسجلة حالياً</p>
        </div>
    @endif
</div>

<!-- Rating Section -->
<div class="card-attorney p-8">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="text-2xl font-bold text-primary mb-2">شاركنا رأيك</h2>
            <p class="text-gray-600">ساعدنا في تحسين خدماتنا من خلال تقييمك</p>
        </div>
        <a href="{{ route('client.ratings.create') }}" class="btn-attorney-primary">
            إرسال تقييم
        </a>
    </div>
</div>
@endsection

