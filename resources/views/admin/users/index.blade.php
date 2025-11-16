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

<div class="card-dashboard p-8">
    @if($users->count() > 0)
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة المستخدمين</h2>
            </div>
            <span class="badge-dashboard badge-processing">{{ $users->total() }} مستخدم</span>
        </div>
        <div class="overflow-x-auto">
            <table class="table-dashboard">
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
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" 
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

