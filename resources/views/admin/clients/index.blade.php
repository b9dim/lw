@extends('layouts.admin')

@section('title', 'إدارة العملاء')

@section('content')
<div class="mb-8 lg:mb-12">
    <div class="flex justify-between items-center mb-6 lg:mb-8">
        <div>
            <h1 class="text-4xl lg:text-5xl font-bold text-primary mb-2 lg:mb-3">إدارة العملاء</h1>
            <p class="text-gray-600 text-lg lg:text-xl">إدارة بيانات العملاء والقضايا المرتبطة بهم</p>
        </div>
        <a href="{{ route('admin.clients.create') }}" class="btn-attorney-primary">
            إضافة عميل جديد
        </a>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8 lg:p-10">
    @if($clients->count() > 0)
        <div class="mb-6 lg:mb-8 flex items-center justify-between flex-wrap gap-3 lg:gap-4">
            <div class="flex items-center gap-3 lg:gap-4">
                <div class="w-1 h-8 lg:h-10 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl lg:text-3xl font-bold text-primary">قائمة العملاء</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-sm font-semibold text-slate-600 shadow-inner">{{ $clients->total() }} عميل</span>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <div class="min-w-[860px] overflow-hidden rounded-[30px] border border-slate-200/70 bg-white shadow-[0_35px_70px_rgba(15,23,42,0.08)]">
                <table class="min-w-full text-right text-sm text-slate-600">
                    <thead class="bg-slate-50">
                        <tr class="text-[0.72rem] font-semibold uppercase  text-slate-500">
                            <th class="px-6 py-4 text-right first:rounded-tl-[30px] last:rounded-tr-[30px]">الاسم</th>
                            <th class="px-6 py-4 text-right">رقم الهوية</th>
                            <th class="px-6 py-4 text-right">الهاتف</th>
                            <th class="px-6 py-4 text-right">البريد الإلكتروني</th>
                            <th class="px-6 py-4 text-right">عدد القضايا</th>
                            <th class="px-6 py-4 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($clients as $client)
                            <tr class="js-clickable-row transition-all duration-200 hover:bg-white hover:shadow-[0_18px_45px_rgba(15,23,42,0.08)] hover:-translate-y-0.5 odd:bg-white even:bg-slate-50/60" data-row-href="{{ route('admin.clients.show', $client->id) }}" tabindex="0" role="link" aria-label="عرض تفاصيل العميل {{ $client->name }}">
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm font-semibold text-slate-900">{{ $client->name }}</p>
                                    <p class="text-[11px] text-slate-400 mt-1">أضيف {{ $client->created_at->format('Y-m-d') }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="font-mono text-sm text-slate-900">{{ $client->national_id }}</span>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ $client->phone ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ $client->email ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-blue-50 text-blue-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $client->cases->count() }} قضية
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle" data-row-link-ignore>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.clients.show', $client->id) }}" 
                                           class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-l from-primary to-accent px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:shadow-md"
                                           data-row-link-ignore>عرض</a>
                                        <a href="{{ route('admin.clients.edit', $client->id) }}" 
                                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200/80 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-primary hover:text-primary"
                                           data-row-link-ignore>تعديل</a>
                                        <form method="POST" action="{{ force_https_route('admin.clients.destroy', $client->id) }}" 
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
            @foreach($clients as $client)
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_18px_35px_rgba(15,23,42,0.08)] transition-shadow hover:shadow-[0_25px_50px_rgba(15,23,42,0.12)] js-clickable-row" 
                     data-row-href="{{ route('admin.clients.show', $client->id) }}"
                     tabindex="0"
                     role="link"
                     aria-label="عرض تفاصيل العميل {{ $client->name }}">
                    <div class="flex items-start justify-between mb-4 gap-4">
                        <div>
                            <p class="text-[11px] text-slate-500 mb-1">الاسم</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $client->name }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-blue-50 text-blue-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                            {{ $client->cases->count() }} قضية
                        </span>
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">رقم الهوية</p>
                        <p class="font-mono text-sm text-slate-800">{{ $client->national_id }}</p>
                    </div>
                    @if($client->phone)
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">الهاتف</p>
                        <p class="text-sm text-slate-800">{{ $client->phone }}</p>
                    </div>
                    @endif
                    @if($client->email)
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">البريد الإلكتروني</p>
                        <p class="text-sm text-slate-800 break-all">{{ $client->email }}</p>
                    </div>
                    @endif
                    <div class="pt-4 border-t border-slate-100 mt-4 flex flex-wrap gap-2" data-row-link-ignore>
                        <a href="{{ route('admin.clients.show', $client->id) }}" 
                           class="flex-1 rounded-2xl bg-gradient-to-l from-primary to-accent px-3 py-2 text-center text-xs font-semibold text-white"
                           data-row-link-ignore>
                            عرض
                        </a>
                        <a href="{{ route('admin.clients.edit', $client->id) }}" 
                           class="flex-1 rounded-2xl border border-slate-200 px-3 py-2 text-center text-xs font-semibold text-slate-600"
                           data-row-link-ignore>
                            تعديل
                        </a>
                        <form method="POST" action="{{ force_https_route('admin.clients.destroy', $client->id) }}" 
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
            {{ $clients->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-6 opacity-30">👥</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">لا يوجد عملاء مسجلين</h3>
            <p class="text-gray-500 mb-6">ابدأ بإضافة عميل جديد</p>
            <a href="{{ route('admin.clients.create') }}" class="btn-attorney-primary inline-block">
                إضافة عميل جديد
            </a>
        </div>
    @endif
</div>
@endsection

