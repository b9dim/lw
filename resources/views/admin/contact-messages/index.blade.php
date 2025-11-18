@extends('layouts.admin')

@section('title', 'رسائل اتصل بنا')

@section('content')
<div class="mb-8 lg:mb-14">
    <div class="flex justify-between items-center mb-6 lg:mb-8 flex-wrap gap-4 lg:gap-6">
        <div>
            <h1 class="text-4xl lg:text-5xl font-bold text-primary mb-2 lg:mb-4">رسائل اتصل بنا</h1>
            <p class="text-gray-600 text-lg lg:text-xl">إدارة رسائل الاتصال الواردة من الموقع</p>
        </div>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8 lg:p-12">
    @if($messages->count() > 0)
        <div class="mb-6 lg:mb-10 flex items-center justify-between flex-wrap gap-3 lg:gap-5">
            <div class="flex items-center gap-3 lg:gap-5">
                <div class="w-1 h-8 lg:h-12 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl lg:text-3xl font-bold text-primary">قائمة الرسائل</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 lg:px-6 py-1 lg:py-2 text-sm lg:text-lg font-semibold text-slate-600 shadow-inner">{{ $messages->total() }} رسالة</span>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <div class="min-w-[860px] overflow-hidden rounded-[30px] border border-slate-200/70 bg-white shadow-[0_35px_70px_rgba(15,23,42,0.08)]">
                <table class="min-w-full text-right text-sm text-slate-600">
                    <thead class="bg-slate-50">
                        <tr class="text-[0.72rem] font-semibold uppercase  text-slate-500">
                            <th class="px-6 py-4 text-right first:rounded-tl-[30px] last:rounded-tr-[30px]">الاسم</th>
                            <th class="px-6 py-4 text-right">البريد الإلكتروني</th>
                            <th class="px-6 py-4 text-right">الموضوع</th>
                            <th class="px-6 py-4 text-right">الحالة</th>
                            <th class="px-6 py-4 text-right">التاريخ</th>
                            <th class="px-6 py-4 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($messages as $message)
                            <tr class="js-clickable-row transition-all duration-200 hover:bg-white hover:shadow-[0_18px_45px_rgba(15,23,42,0.08)] hover:-translate-y-0.5 {{ !$message->read ? 'bg-blue-50/50' : 'odd:bg-white even:bg-slate-50/60' }}" data-row-href="{{ route('admin.contact-messages.show', $message->id) }}" tabindex="0" role="link" aria-label="عرض تفاصيل الرسالة">
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm font-semibold {{ !$message->read ? 'text-primary' : 'text-slate-900' }}">{{ $message->name }}</p>
                                    @if(!$message->read)
                                        <p class="text-[11px] text-blue-500 mt-1 font-medium">جديدة</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ $message->email }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ Str::limit($message->subject, 50) }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if($message->read)
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-[#F1F5F9] text-[#475569]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            مقروءة
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-[#DBEAFE] text-[#1E40AF]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            جديدة
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ $message->created_at->format('Y-m-d') }}</p>
                                    <p class="text-[11px] text-slate-400 mt-1">{{ $message->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle" data-row-link-ignore>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                           class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:shadow-md"
                                           data-row-link-ignore>عرض</a>
                                        <form method="POST" action="{{ force_https_route('admin.contact-messages.destroy', $message->id) }}" 
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
            @foreach($messages as $message)
                <div class="rounded-2xl border {{ !$message->read ? 'border-blue-200 bg-blue-50/50' : 'border-slate-200 bg-white' }} p-4 shadow-[0_18px_35px_rgba(15,23,42,0.08)] transition-shadow hover:shadow-[0_25px_50px_rgba(15,23,42,0.12)] js-clickable-row" 
                     data-row-href="{{ route('admin.contact-messages.show', $message->id) }}"
                     tabindex="0"
                     role="link"
                     aria-label="عرض تفاصيل الرسالة">
                    <div class="flex items-start justify-between mb-4 gap-4">
                        <div>
                            <p class="text-[11px] text-slate-500 mb-1">الاسم</p>
                            <p class="text-sm font-semibold {{ !$message->read ? 'text-primary' : 'text-slate-900' }}">{{ $message->name }}</p>
                        </div>
                        @if($message->read)
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-[#F1F5F9] text-[#475569]">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                مقروءة
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-[#DBEAFE] text-[#1E40AF]">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                جديدة
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">البريد الإلكتروني</p>
                        <p class="text-sm text-slate-800 break-all">{{ $message->email }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">الموضوع</p>
                        <p class="text-sm text-slate-800">{{ Str::limit($message->subject, 60) }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">التاريخ</p>
                        <p class="text-sm text-slate-800">{{ $message->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4 flex flex-wrap gap-2" data-row-link-ignore>
                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                           class="flex-1 rounded-2xl bg-gradient-to-l from-primary to-accent px-3 py-2 text-center text-xs font-semibold text-white"
                           data-row-link-ignore>
                            عرض
                        </a>
                        <form method="POST" action="{{ force_https_route('admin.contact-messages.destroy', $message->id) }}" 
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
            {{ $messages->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-6 opacity-30">📧</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">لا توجد رسائل</h3>
            <p class="text-gray-500">لا توجد رسائل اتصال واردة حالياً</p>
        </div>
    @endif
</div>
@endsection

