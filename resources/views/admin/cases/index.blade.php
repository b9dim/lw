@extends('layouts.admin')

@section('title', 'إدارة القضايا')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold text-primary mb-2">إدارة القضايا</h1>
            <p class="text-gray-600 text-lg">إدارة جميع القضايا والمتابعة</p>
        </div>
        <a href="{{ route('admin.cases.create') }}" class="btn-attorney-primary">
            إضافة قضية جديدة
        </a>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8">
    @if($cases->count() > 0)
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة القضايا</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-sm font-semibold text-slate-600 shadow-inner">{{ $cases->total() }} قضية</span>
        </div>
        @php
            $statusBadgePalette = [
                'قيد المعالجة' => 'bg-[#DDF3EA] text-[#2B8A4A]',
                'قيد المحاكمة' => 'bg-blue-50 text-blue-600',
                'مكتملة' => 'bg-emerald-50 text-emerald-600',
                'منتهية' => 'bg-slate-100 text-slate-600',
                'مغلقة' => 'bg-slate-100 text-slate-600',
                'معلقة' => 'bg-amber-50 text-amber-600',
            ];
        @endphp
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <div class="min-w-[860px] overflow-hidden rounded-[30px] border border-slate-200/70 bg-white shadow-[0_35px_70px_rgba(15,23,42,0.08)]">
                <table class="min-w-full text-right text-sm text-slate-600">
                    <thead class="bg-slate-50">
                        <tr class="text-[0.72rem] font-semibold uppercase tracking-[0.25em] text-slate-500">
                            <th class="px-6 py-4 text-right first:rounded-tl-[30px] last:rounded-tr-[30px]">رقم القضية</th>
                            <th class="px-6 py-4 text-right">العميل</th>
                            <th class="px-6 py-4 text-right">المحكمة</th>
                            <th class="px-6 py-4 text-right">الحالة</th>
                            <th class="px-6 py-4 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($cases as $case)
                            @php
                                $badgeClass = $statusBadgePalette[$case->status] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <tr class="js-clickable-row transition-all duration-200 hover:bg-white hover:shadow-[0_18px_45px_rgba(15,23,42,0.08)] hover:-translate-y-0.5 odd:bg-white even:bg-slate-50/60" data-row-href="{{ route('admin.cases.show', $case->id) }}" tabindex="0" role="link" aria-label="عرض تفاصيل القضية رقم {{ $case->case_number }}">
                                <td class="px-6 py-4 align-middle">
                                    <div class="inline-flex items-center gap-2 rounded-2xl border border-[#E5E7EB] bg-white/80 px-4 py-2 font-semibold text-slate-900 shadow-sm">
                                        <span class="text-[10px] uppercase tracking-[0.35em] text-slate-400">قضية</span>
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
                                        <a href="{{ route('admin.cases.edit', $case->id) }}" 
                                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200/80 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-primary hover:text-primary"
                                           data-row-link-ignore>تعديل</a>
                                        <form method="POST" action="{{ force_https_route('admin.cases.destroy', $case->id) }}" 
                                              class="inline-flex"
                                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')"
                                              data-row-link-ignore>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-red-200/70 px-4 py-2 text-xs font-semibold text-red-600 transition hover:border-red-400" data-row-link-ignore>حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($cases as $case)
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
                    <div class="case-last-update flex items-center justify-between rounded-2xl border border-white/60 bg-slate-50/80 px-4 py-3 text-[11px] text-slate-600">
                        <span>آخر تحديث</span>
                        <span class="text-right text-[11px] font-semibold">{{ $case->last_update_text ?? 'لا يوجد تحديث مضاف بعد' }}</span>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4 flex flex-wrap gap-2" data-row-link-ignore>
                        <a href="{{ route('admin.cases.show', $case->id) }}" 
                           class="flex-1 rounded-2xl bg-gradient-to-l from-primary to-accent px-3 py-2 text-center text-xs font-semibold text-white"
                           data-row-link-ignore>
                            عرض
                        </a>
                        <a href="{{ route('admin.cases.edit', $case->id) }}" 
                           class="flex-1 rounded-2xl border border-slate-200 px-3 py-2 text-center text-xs font-semibold text-slate-600"
                           data-row-link-ignore>
                            تعديل
                        </a>
                        <form method="POST" action="{{ force_https_route('admin.cases.destroy', $case->id) }}" 
                              class="flex-1"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')"
                              data-row-link-ignore>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full rounded-2xl border border-red-200 px-3 py-2 text-xs font-semibold text-red-600" data-row-link-ignore>
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6 flex justify-center">
            {{ $cases->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-6 opacity-30">⚖️</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">لا توجد قضايا مسجلة</h3>
            <p class="text-gray-500 mb-6">ابدأ بإضافة قضية جديدة</p>
            <a href="{{ route('admin.cases.create') }}" class="btn-attorney-primary inline-block">
                إضافة قضية جديدة
            </a>
        </div>
    @endif
</div>
@endsection

