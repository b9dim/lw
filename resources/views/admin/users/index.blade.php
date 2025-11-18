@extends('layouts.admin')

@section('title', 'إدارة المستخدمين')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold text-primary mb-2">إدارة المستخدمين</h1>
            <p class="text-gray-600 text-lg">إدارة حسابات المستخدمين والصلاحيات</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-attorney-primary">
            إضافة مستخدم جديد
        </a>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8">
    @if($users->count() > 0)
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة المستخدمين</h2>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-sm font-semibold text-slate-600 shadow-inner">{{ $users->total() }} مستخدم</span>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <div class="min-w-[860px] overflow-hidden rounded-[30px] border border-slate-200/70 bg-white shadow-[0_35px_70px_rgba(15,23,42,0.08)]">
                <table class="min-w-full text-right text-sm text-slate-600">
                    <thead class="bg-slate-50">
                        <tr class="text-[0.72rem] font-semibold uppercase  text-slate-500">
                            <th class="px-6 py-4 text-right first:rounded-tl-[30px] last:rounded-tr-[30px]">الاسم</th>
                            <th class="px-6 py-4 text-right">البريد الإلكتروني</th>
                            <th class="px-6 py-4 text-right">الدور</th>
                            <th class="px-6 py-4 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                            <tr class="transition-all duration-200 hover:bg-white hover:shadow-[0_18px_45px_rgba(15,23,42,0.08)] hover:-translate-y-0.5 odd:bg-white even:bg-slate-50/60">
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm font-semibold text-slate-900">{{ $user->name }}</p>
                                    <p class="text-[11px] text-slate-400 mt-1">أضيف {{ $user->created_at->format('Y-m-d') }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm text-slate-900">{{ $user->email }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if($user->role == 'مدير')
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-red-50 text-red-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $user->role }}
                                        </span>
                                    @elseif($user->role == 'محامي')
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-blue-50 text-blue-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $user->role }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1 text-xs font-semibold shadow-sm bg-amber-50 text-amber-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $user->role }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="inline-flex items-center justify-center rounded-2xl border border-slate-200/80 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-primary hover:text-primary">تعديل</a>
                                        @if(!$user->isAdmin() || $adminCount > 1)
                                            <form method="POST" action="{{ force_https_route('admin.users.destroy', $user->id) }}" 
                                                  class="inline-flex"
                                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-red-200/70 px-4 py-2 text-xs font-semibold text-red-600 transition hover:border-red-400">حذف</button>
                                            </form>
                                        @endif
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
            @foreach($users as $user)
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_18px_35px_rgba(15,23,42,0.08)] transition-shadow hover:shadow-[0_25px_50px_rgba(15,23,42,0.12)]">
                    <div class="flex items-start justify-between mb-4 gap-4">
                        <div>
                            <p class="text-[11px] text-slate-500 mb-1">الاسم</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $user->name }}</p>
                        </div>
                        @if($user->role == 'مدير')
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-red-50 text-red-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $user->role }}
                            </span>
                        @elseif($user->role == 'محامي')
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-blue-50 text-blue-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $user->role }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold bg-amber-50 text-amber-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $user->role }}
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="text-[11px] text-slate-500 mb-1">البريد الإلكتروني</p>
                        <p class="text-sm text-slate-800 break-all">{{ $user->email }}</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4 flex flex-wrap gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                           class="flex-1 rounded-2xl border border-slate-200 px-3 py-2 text-center text-xs font-semibold text-slate-600">
                            تعديل
                        </a>
                        @if(!$user->isAdmin() || $adminCount > 1)
                            <form method="POST" action="{{ force_https_route('admin.users.destroy', $user->id) }}" 
                                  class="flex-1"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full rounded-2xl border border-red-200 px-3 py-2 text-xs font-semibold text-red-600">
                                    حذف
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6 flex justify-center">
            {{ $users->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-6 opacity-30">👤</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">لا يوجد مستخدمون</h3>
            <p class="text-gray-500 mb-6">ابدأ بإضافة مستخدم جديد</p>
            <a href="{{ route('admin.users.create') }}" class="btn-attorney-primary inline-block">
                إضافة مستخدم جديد
            </a>
        </div>
    @endif
</div>
@endsection

