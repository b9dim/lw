@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-primary mb-2">لوحة التحكم</h1>
    <p class="text-gray-600 text-lg">نظرة عامة على النظام والإحصائيات</p>
</div>

<!-- Stats Cards -->
<div class="mb-8">
    <!-- Mobile: Organized Grid -->
    <div class="grid grid-cols-2 gap-3 md:hidden">
        <div class="card-dashboard p-4">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="stat-label text-[11px] mb-1.5 text-slate-500">إجمالي القضايا</p>
                    <p class="stat-number text-primary text-2xl font-bold leading-tight">{{ $stats['total_cases'] }}</p>
                </div>
                <div class="icon-circle icon-circle-sm text-primary flex-shrink-0">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-4 h-4">
                        <path d="M12 4v15" />
                        <path d="M7 19h10" />
                        <path d="m5 10 3 6 3-6" />
                        <path d="m13 10 3 6 3-6" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-4">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="stat-label text-[11px] mb-1.5 text-slate-500">القضايا النشطة</p>
                    <p class="stat-number text-xl font-bold leading-tight" style="color: #0066cc;">{{ $stats['active_cases'] }}</p>
                </div>
                <div class="icon-circle icon-circle-sm text-primary flex-shrink-0">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-4 h-4">
                        <path d="M9 12h6" />
                        <path d="M9 16h4" />
                        <path d="M12 3H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V9l-6-6z" />
                        <path d="M14 3v5h5" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-4">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="stat-label text-[11px] mb-1.5 text-slate-500">إجمالي العملاء</p>
                    <p class="stat-number text-xl font-bold leading-tight" style="color: #7c3aed;">{{ $stats['total_clients'] }}</p>
                </div>
                <div class="icon-circle icon-circle-sm text-primary flex-shrink-0">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-4 h-4">
                        <circle cx="9" cy="7" r="4" />
                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 7a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" />
                        <path d="M16 21v-2a4 4 0 0 0-4-4h-2" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-4">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="stat-label text-[11px] mb-1.5 text-slate-500">استفسارات معلقة</p>
                    <p class="stat-number text-xl font-bold leading-tight" style="color: #dc2626;">{{ $stats['pending_inquiries'] }}</p>
                </div>
                <div class="icon-circle icon-circle-sm icon-circle-accent flex-shrink-0">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-4 h-4">
                        <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-4 col-span-2">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="stat-label text-[11px] mb-1.5 text-slate-500">رسائل غير مقروءة</p>
                    <p class="stat-number text-xl font-bold leading-tight" style="color: #f59e0b;">{{ $stats['unread_messages'] }}</p>
                </div>
                <div class="icon-circle icon-circle-sm text-primary flex-shrink-0">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-4 h-4">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Desktop: Grid -->
    <div class="hidden md:grid grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">إجمالي القضايا</p>
                    <p class="stat-number text-primary">{{ $stats['total_cases'] }}</p>
                </div>
                <div class="icon-circle icon-circle-lg text-primary">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 4v15" />
                        <path d="M7 19h10" />
                        <path d="m5 10 3 6 3-6" />
                        <path d="m13 10 3 6 3-6" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">القضايا النشطة</p>
                    <p class="stat-number" style="color: #0066cc;">{{ $stats['active_cases'] }}</p>
                </div>
                <div class="icon-circle icon-circle-lg text-primary">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M9 12h6" />
                        <path d="M9 16h4" />
                        <path d="M12 3H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V9l-6-6z" />
                        <path d="M14 3v5h5" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">إجمالي العملاء</p>
                    <p class="stat-number" style="color: #7c3aed;">{{ $stats['total_clients'] }}</p>
                </div>
                <div class="icon-circle icon-circle-lg text-primary">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="9" cy="7" r="4" />
                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 7a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" />
                        <path d="M16 21v-2a4 4 0 0 0-4-4h-2" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">استفسارات معلقة</p>
                    <p class="stat-number" style="color: #dc2626;">{{ $stats['pending_inquiries'] }}</p>
                </div>
                <div class="icon-circle icon-circle-lg icon-circle-accent">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-dashboard">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">رسائل غير مقروءة</p>
                    <p class="stat-number" style="color: #f59e0b;">{{ $stats['unread_messages'] }}</p>
                </div>
                <div class="icon-circle icon-circle-lg text-primary">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Cases -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card-dashboard p-4 md:p-8">
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">آخر القضايا</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-sm font-semibold text-slate-600 shadow-inner">{{ $recentCases->count() }} قضية</span>
        </div>
        @if($recentCases->count() > 0)
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
            @endphp
            
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto mb-6">
                <div class="min-w-[860px] overflow-hidden rounded-[30px] border border-slate-200/70 bg-white shadow-[0_35px_70px_rgba(15,23,42,0.08)]">
                    <table class="min-w-full text-right text-sm text-slate-600">
                        <thead class="bg-slate-50">
                            <tr class="text-[0.72rem] font-semibold uppercase  text-slate-500">
                                <th class="px-6 py-4 text-right first:rounded-tl-[30px] last:rounded-tr-[30px]">رقم القضية</th>
                                <th class="px-6 py-4 text-right">العميل</th>
                                <th class="px-6 py-4 text-right">المحكمة</th>
                                <th class="px-6 py-4 text-right">الحالة</th>
                                <th class="px-6 py-4 text-right">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($recentCases as $case)
                                @php
                                    $badgeClass = $statusBadgePalette[$case->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <tr class="js-clickable-row transition-all duration-200 hover:bg-white hover:shadow-[0_18px_45px_rgba(15,23,42,0.08)] hover:-translate-y-0.5 odd:bg-white even:bg-slate-50/60" data-row-href="{{ route('admin.cases.show', $case->id) }}" tabindex="0" role="link" aria-label="عرض تفاصيل القضية رقم {{ $case->case_number }}">
                                    <td class="px-6 py-4 align-middle">
                                        <div class="inline-flex items-center gap-2 rounded-2xl border border-[#E5E7EB] bg-white/80 px-4 py-2 font-semibold text-slate-900 shadow-sm">
                                            <span class="text-[10px] uppercase text-slate-400">قضية</span>
                                            <span class="font-mono text-base text-slate-900">{{ $case->case_number }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        <p class="text-sm font-semibold text-slate-900">{{ $case->client->name }}</p>
                                        <p class="text-[11px] text-slate-400 mt-1">أضيفت {{ $case->created_at->format('Y-m-d') }}</p>
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        <p class="text-sm font-medium text-slate-900">{{ $case->court_name ?? '-' }}</p>
                                        <p class="text-[11px] text-slate-400 mt-1">القضية #{{ $case->id }}</p>
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        <div class="flex flex-col gap-2 text-right">
                                            <span class="inline-flex w-max items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm {{ $badgeClass }}">
                                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                                {{ $case->status }}
                                            </span>
                                            <div class="case-last-update inline-flex items-center gap-2 rounded-2xl border border-white/60 bg-white/70 px-3 py-2 text-[11px] font-medium text-slate-500">
                                                <svg viewBox="0 0 24 24" class="h-4 w-4 text-primary/70" aria-hidden="true">
                                                    <circle cx="12" cy="12" r="8.5" fill="none" stroke="currentColor" stroke-width="1.2"></circle>
                                                    <path d="M12 8v4.2l2.8 1.6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.2"></path>
                                                </svg>
                                                <span>{{ $case->last_update_text ?? 'لا يوجد تحديث مضاف بعد' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-middle" data-row-link-ignore>
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.cases.show', $case->id) }}" 
                                               class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:shadow-md"
                                               data-row-link-ignore>عرض</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4 mb-6">
                @foreach($recentCases as $case)
                    @php
                        $badgeClass = $statusBadgePalette[$case->status] ?? 'bg-gray-100 text-gray-600';
                    @endphp
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_18px_35px_rgba(15,23,42,0.08)] transition-shadow hover:shadow-[0_25px_50px_rgba(15,23,42,0.12)] js-clickable-row" 
                         data-row-href="{{ route('admin.cases.show', $case->id) }}"
                         tabindex="0"
                         role="link"
                         aria-label="عرض تفاصيل القضية رقم {{ $case->case_number }}">
                        <div class="flex items-start justify-between mb-4 gap-4">
                            <div>
                                <p class="text-[11px] text-slate-500 mb-1">رقم القضية</p>
                                <div class="inline-flex items-center rounded-2xl border border-[#E5E7EB] bg-slate-50/80 px-3 py-1.5 font-semibold text-slate-900">
                                    <span class="font-mono text-sm">{{ $case->case_number }}</span>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold {{ $badgeClass }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $case->status }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <p class="text-[11px] text-slate-500 mb-1">العميل</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $case->client->name }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-[11px] text-slate-500 mb-1">المحكمة</p>
                            <p class="text-sm text-slate-800">{{ $case->court_name ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-[11px] text-slate-500 mb-1">آخر تحديث</p>
                            <div class="case-last-update inline-flex items-center gap-2 rounded-2xl border border-white/60 bg-white/70 px-3 py-2 text-[11px] font-medium text-slate-500">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 text-primary/70" aria-hidden="true">
                                    <circle cx="12" cy="12" r="8.5" fill="none" stroke="currentColor" stroke-width="1.2"></circle>
                                    <path d="M12 8v4.2l2.8 1.6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.2"></path>
                                </svg>
                                <span>{{ $case->last_update_text ?? 'لا يوجد تحديث مضاف بعد' }}</span>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-100 mt-4" data-row-link-ignore>
                            <a href="{{ route('admin.cases.show', $case->id) }}" 
                               class="flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-3 py-2 text-center text-xs font-semibold text-white"
                               data-row-link-ignore>
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                <a href="{{ route('admin.cases.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
                    <span>عرض الكل</span>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 18l6-6-6-6" />
                    </svg>
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4 opacity-30">⚖️</div>
                <p class="text-gray-600 text-lg">لا توجد قضايا</p>
            </div>
        @endif
    </div>

    <div class="card-dashboard p-4 md:p-8">
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">استفسارات معلقة</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-sm font-semibold text-slate-600 shadow-inner">{{ $recentInquiries->count() }} استفسار</span>
        </div>
        @if($recentInquiries->count() > 0)
            <div class="space-y-3">
                @foreach($recentInquiries as $inquiry)
                    <div class="rounded-2xl border border-slate-200/70 bg-white p-4 shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="inline-flex items-center gap-2 rounded-2xl border border-[#E5E7EB] bg-white/80 px-3 py-1.5 font-semibold text-slate-900 shadow-sm mb-2">
                                    <span class="text-[10px] uppercase  text-slate-400">قضية</span>
                                    <span class="font-mono text-sm text-slate-900">{{ $inquiry->case->case_number }}</span>
                                </div>
                                <p class="text-sm font-semibold text-slate-900">{{ $inquiry->client->name }}</p>
                                <p class="text-sm text-slate-600 mt-1">{{ Str::limit($inquiry->message, 50) }}</p>
                                <p class="text-[11px] text-slate-400 mt-1">{{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                               class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:shadow-md flex-shrink-0">عرض</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
                    <span>عرض الكل</span>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 18l6-6-6-6" />
                    </svg>
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4 opacity-30">💬</div>
                <p class="text-gray-600 text-lg">لا توجد استفسارات معلقة</p>
            </div>
        @endif
    </div>

    <div class="card-dashboard p-4 md:p-8">
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">تقييمات قيد المراجعة</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-sm font-semibold text-slate-600 shadow-inner">{{ $recentRatings->count() }} تقييم</span>
        </div>
        @if($recentRatings->count() > 0)
            <div class="space-y-3">
                @foreach($recentRatings as $rating)
                    <div class="rounded-2xl border border-slate-200/70 bg-white p-4 shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-900">{{ $rating->client->name }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <div class="flex gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="text-lg {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-slate-600 font-medium">({{ $rating->rating }}/5)</span>
                                </div>
                                @if($rating->comment)
                                    <p class="text-sm text-slate-600 mt-2">{{ Str::limit($rating->comment, 60) }}</p>
                                @endif
                                <p class="text-[11px] text-slate-400 mt-2">{{ $rating->created_at->format('Y-m-d') }}</p>
                            </div>
                            <a href="{{ route('admin.ratings.index') }}" 
                               class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:shadow-md flex-shrink-0">عرض</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.ratings.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
                    <span>عرض الكل</span>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 18l6-6-6-6" />
                    </svg>
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4 opacity-30">⭐</div>
                <p class="text-gray-600 text-lg">لا توجد تقييمات قيد المراجعة</p>
            </div>
        @endif
    </div>
</div>
@endsection

