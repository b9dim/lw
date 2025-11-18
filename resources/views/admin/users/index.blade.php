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
            <span class="badge-dashboard badge-processing">{{ $users->total() }} مستخدم</span>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="table-dashboard w-full">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الدور</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="font-semibold text-primary">{{ $user->name }}</td>
                            <td class="text-gray-700">{{ $user->email }}</td>
                            <td>
                                @if($user->role == 'مدير')
                                    <span class="badge-dashboard badge-cancelled">
                                        {{ $user->role }}
                                    </span>
                                @elseif($user->role == 'محامي')
                                    <span class="badge-dashboard badge-trial">
                                        {{ $user->role }}
                                    </span>
                                @else
                                    <span class="badge-dashboard badge-processing">
                                        {{ $user->role }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="action-link action-link-edit">تعديل</a>
                                    @if(!$user->isAdmin() || $adminCount > 1)
                                        <form method="POST" action="{{ force_https_route('admin.users.destroy', $user->id) }}" 
                                              class="inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-link action-link-delete">حذف</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($users as $user)
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">الاسم</p>
                            <p class="text-gray-800 font-semibold text-sm">{{ $user->name }}</p>
                        </div>
                        @if($user->role == 'مدير')
                            <span class="badge-dashboard badge-cancelled text-xs ml-2 flex-shrink-0">{{ $user->role }}</span>
                        @elseif($user->role == 'محامي')
                            <span class="badge-dashboard badge-trial text-xs ml-2 flex-shrink-0">{{ $user->role }}</span>
                        @else
                            <span class="badge-dashboard badge-processing text-xs ml-2 flex-shrink-0">{{ $user->role }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">البريد الإلكتروني</p>
                        <p class="text-gray-800 text-sm break-all">{{ $user->email }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-100 flex gap-2 flex-wrap">
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                           class="flex-1 text-center px-3 py-2 bg-accent/10 text-accent rounded-lg hover:bg-accent/20 transition-colors text-sm font-semibold">
                            تعديل
                        </a>
                        @if(!$user->isAdmin() || $adminCount > 1)
                            <form method="POST" action="{{ force_https_route('admin.users.destroy', $user->id) }}" 
                                  class="flex-1" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-semibold">
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

