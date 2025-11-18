@extends('layouts.admin')

@section('title', 'إدارة الاستفسارات')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold text-primary mb-2">إدارة الاستفسارات</h1>
            <p class="text-gray-600 text-lg">إدارة استفسارات العملاء والرد عليها</p>
        </div>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8">
    @if($inquiries->count() > 0)
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة الاستفسارات</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-sm font-semibold text-slate-600 shadow-inner">{{ $inquiries->total() }} استفسار</span>
        </div>
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <div class="min-w-[860px] overflow-hidden rounded-[30px] border border-slate-200/70 bg-white shadow-[0_35px_70px_rgba(15,23,42,0.08)]">
                <table class="min-w-full text-right text-sm text-slate-600">
                    <thead class="bg-slate-50">
                        <tr class="text-[0.72rem] font-semibold uppercase tracking-[0.25em] text-slate-500">
                            <th class="px-6 py-4 text-right first:rounded-tl-[30px] last:rounded-tr-[30px]">رقم القضية</th>
                            <th class="px-6 py-4 text-right">العميل</th>
                            <th class="px-6 py-4 text-right">الرسالة</th>
                            <th class="px-6 py-4 text-right">الحالة</th>
                            <th class="px-6 py-4 text-right">التاريخ</th>
                            <th class="px-6 py-4 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($inquiries as $inquiry)
                            <tr class="js-clickable-row transition-all duration-200 hover:bg-white hover:shadow-[0_18px_45px_rgba(15,23,42,0.08)] hover:-translate-y-0.5 odd:bg-white even:bg-slate-50/60" data-row-href="{{ route('admin.inquiries.show', $inquiry->id) }}" tabindex="0" role="link" aria-label="عرض تفاصيل الاستفسار">
                                <td class="px-6 py-4 align-middle">
                                    <div class="inline-flex items-center gap-2 rounded-2xl border border-[#E5E7EB] bg-white/80 px-4 py-2 font-semibold text-slate-900 shadow-sm">
                                        <span class="text-[10px] uppercase tracking-[0.35em] text-slate-400">قضية</span>
                                        <span class="font-mono text-base text-slate-900">{{ $inquiry->case->case_number }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm font-semibold text-slate-900">{{ $inquiry->client->name }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ Str::limit($inquiry->message, 50) }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if($inquiry->reply)
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-[#D1FAE5] text-[#065F46]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            تم الرد
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-[#FEF3C7] text-[#92400E]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            في الانتظار
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ $inquiry->created_at->format('Y-m-d') }}</p>
                                    <p class="text-[11px] text-slate-400 mt-1">{{ $inquiry->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle" data-row-link-ignore>
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                                       class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:shadow-md"
                                       data-row-link-ignore>عرض</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($inquiries as $inquiry)
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_18px_35px_rgba(15,23,42,0.08)] transition-shadow hover:shadow-[0_25px_50px_rgba(15,23,42,0.12)] js-clickable-row" 
                     data-row-href="{{ route('admin.inquiries.show', $inquiry->id) }}"
                     tabindex="0"
                     role="link"
                     aria-label="عرض تفاصيل الاستفسار">
                    <div class="flex items-start justify-between mb-4 gap-4">
                        <div>
                            <p class="text-[11px] text-slate-500 mb-1">رقم القضية</p>
                            <div class="inline-flex items-center rounded-2xl border border-[#E5E7EB] bg-slate-50/80 px-3 py-1.5 font-semibold text-slate-900">
                                <span class="font-mono text-sm">{{ $inquiry->case->case_number }}</span>
                            </div>
                        </div>
                        @if($inquiry->reply)
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-[#D1FAE5] text-[#065F46]">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                تم الرد
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-[#FEF3C7] text-[#92400E]">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                في الانتظار
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">العميل</p>
                        <p class="text-sm font-semibold text-slate-900">{{ $inquiry->client->name }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">الرسالة</p>
                        <p class="text-sm text-slate-800">{{ Str::limit($inquiry->message, 100) }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">التاريخ</p>
                        <p class="text-sm text-slate-800">{{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4" data-row-link-ignore>
                        <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                           class="flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-3 py-2 text-center text-xs font-semibold text-white"
                           data-row-link-ignore>
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6 flex justify-center">
            {{ $inquiries->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-6 opacity-30">💬</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">لا توجد استفسارات</h3>
            <p class="text-gray-500">لا توجد استفسارات مسجلة حالياً</p>
        </div>
    @endif
</div>
@endsection

