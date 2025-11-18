@extends('layouts.admin')

@section('title', 'تفاصيل العميل')

@section('content')
<div class="mb-6 lg:mb-8">
    <a href="{{ route('admin.clients.index') }}" class="text-primary hover:underline font-semibold lg:text-lg">
        ← العودة إلى قائمة العملاء
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
    <div class="lg:col-span-2">
        <div class="card-attorney p-8 lg:p-10 mb-6 lg:mb-8">
            <div class="flex justify-between items-start mb-6 lg:mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold text-primary">معلومات العميل</h1>
                <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn-attorney-secondary">تعديل</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="info-item">
                    <p class="text-gray-600 mb-2 font-semibold">الاسم</p>
                    <p class="text-xl font-bold text-primary">{{ $client->name }}</p>
                </div>
                <div class="info-item">
                    <p class="text-gray-600 mb-2 font-semibold">رقم الهوية</p>
                    <p class="text-lg font-semibold">{{ $client->national_id }}</p>
                </div>
                <div class="info-item">
                    <p class="text-gray-600 mb-2 font-semibold">الهاتف</p>
                    <p class="text-lg">{{ $client->phone ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <p class="text-gray-600 mb-2 font-semibold">البريد الإلكتروني</p>
                    <p class="text-lg">{{ $client->email ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="card-attorney p-8 lg:p-10">
            <h2 class="text-2xl lg:text-3xl font-bold text-primary mb-6 lg:mb-8">قضايا العميل</h2>
            @if($client->cases->count() > 0)
                <div class="space-y-4">
                    @foreach($client->cases as $case)
                        <div class="case-item-card">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="font-bold text-lg text-primary mb-1">{{ $case->case_number }}</p>
                                    <p class="text-sm text-gray-600 mb-2">{{ $case->court_name ?? 'غير محدد' }}</p>
                                    <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }}">
                                        {{ $case->status }}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <a href="{{ route('admin.cases.show', $case->id) }}" 
                                       class="action-link action-link-view">عرض التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4 opacity-50">⚖️</div>
                    <p class="text-gray-600 text-lg">لا توجد قضايا</p>
                </div>
            @endif
        </div>
    </div>

    <div>
        <div class="card-dashboard">
            <h3 class="text-xl font-bold text-primary mb-6">إحصائيات</h3>
            <div class="space-y-6">
                <div>
                    <p class="stat-label">إجمالي القضايا</p>
                    <p class="stat-number text-primary">{{ $client->cases->count() }}</p>
                </div>
                <div>
                    <p class="stat-label">القضايا النشطة</p>
                    <p class="stat-number" style="color: #0066cc;">
                        {{ $client->cases->whereIn('status', ['قيد المعالجة', 'قيد المحاكمة'])->count() }}
                    </p>
                </div>
                <div>
                    <p class="stat-label">القضايا المكتملة</p>
                    <p class="stat-number" style="color: #006600;">
                        {{ $client->cases->where('status', 'مكتملة')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

