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

<div class="card-dashboard p-8">
    @if($clients->count() > 0)
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة العملاء</h2>
            </div>
            <span class="badge-dashboard badge-processing">{{ $clients->total() }} عميل</span>
        </div>
        <div class="overflow-x-auto">
            <table class="table-dashboard">
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
                                    <form method="POST" action="{{ secure_url(route('admin.clients.destroy', $client->id)) }}" 
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

