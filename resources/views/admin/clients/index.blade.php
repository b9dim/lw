@extends('layouts.admin')

@section('title', 'إدارة العملاء')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold text-primary mb-2">إدارة العملاء</h1>
            <p class="text-gray-600 text-lg">إدارة بيانات العملاء والقضايا المرتبطة بهم</p>
        </div>
        <a href="{{ route('admin.clients.create') }}" class="btn-attorney-primary">
            إضافة عميل جديد
        </a>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8">
    @if($clients->count() > 0)
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة العملاء</h2>
            </div>
            <span class="badge-dashboard badge-processing">{{ $clients->total() }} عميل</span>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="table-dashboard w-full">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>رقم الهوية</th>
                        <th>الهاتف</th>
                        <th>البريد الإلكتروني</th>
                        <th>عدد القضايا</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td class="font-semibold text-primary">{{ $client->name }}</td>
                            <td class="font-mono text-gray-700">{{ $client->national_id }}</td>
                            <td>{{ $client->phone ?? '-' }}</td>
                            <td>{{ $client->email ?? '-' }}</td>
                            <td>
                                <span class="badge-dashboard badge-trial">
                                    {{ $client->cases->count() }} قضية
                                </span>
                            </td>
                            <td>
                                <div class="flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.clients.show', $client->id) }}" 
                                       class="action-link action-link-view">عرض</a>
                                    <a href="{{ route('admin.clients.edit', $client->id) }}" 
                                       class="action-link action-link-edit">تعديل</a>
                                    <form method="POST" action="{{ force_https_route('admin.clients.destroy', $client->id) }}" 
                                          class="inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-link action-link-delete">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($clients as $client)
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">الاسم</p>
                            <p class="text-gray-800 font-semibold text-sm">{{ $client->name }}</p>
                        </div>
                        <span class="badge-dashboard badge-trial text-xs ml-2 flex-shrink-0">
                            {{ $client->cases->count() }} قضية
                        </span>
                    </div>
                    <div class="mb-2">
                        <p class="text-xs text-gray-500 mb-1">رقم الهوية</p>
                        <p class="font-mono text-gray-700 text-sm">{{ $client->national_id }}</p>
                    </div>
                    @if($client->phone)
                    <div class="mb-2">
                        <p class="text-xs text-gray-500 mb-1">الهاتف</p>
                        <p class="text-gray-800 text-sm">{{ $client->phone }}</p>
                    </div>
                    @endif
                    @if($client->email)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">البريد الإلكتروني</p>
                        <p class="text-gray-800 text-sm break-all">{{ $client->email }}</p>
                    </div>
                    @endif
                    <div class="pt-3 border-t border-gray-100 flex gap-2 flex-wrap">
                        <a href="{{ route('admin.clients.show', $client->id) }}" 
                           class="flex-1 text-center px-3 py-2 bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors text-sm font-semibold">
                            عرض
                        </a>
                        <a href="{{ route('admin.clients.edit', $client->id) }}" 
                           class="flex-1 text-center px-3 py-2 bg-accent/10 text-accent rounded-lg hover:bg-accent/20 transition-colors text-sm font-semibold">
                            تعديل
                        </a>
                        <form method="POST" action="{{ force_https_route('admin.clients.destroy', $client->id) }}" 
                              class="flex-1" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-semibold">
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

