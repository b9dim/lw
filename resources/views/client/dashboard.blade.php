@extends('layouts.client')

@section('title', 'لوحة العميل')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-primary mb-2">مرحباً، {{ auth()->guard('client')->user()->name }}</h1>
    <p class="text-gray-600 text-lg">تابع قضاياك واستفساراتك من هنا</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">إجمالي القضايا</p>
                <p class="stat-number text-primary">{{ $cases->count() }}</p>
            </div>
            <div class="text-5xl opacity-20">⚖️</div>
        </div>
    </div>
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">قضايا قيد المعالجة</p>
                <p class="stat-number" style="color: #0066cc;">
                    {{ $cases->where('status', 'قيد المعالجة')->count() }}
                </p>
            </div>
            <div class="text-5xl opacity-20">📋</div>
        </div>
    </div>
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">قضايا قيد المحاكمة</p>
                <p class="stat-number" style="color: #7c3aed;">
                    {{ $cases->where('status', 'قيد المحاكمة')->count() }}
                </p>
            </div>
            <div class="text-5xl opacity-20">🏛️</div>
        </div>
    </div>
</div>

<!-- Cases List -->
<div class="card-attorney p-8 mb-8">
    <h2 class="text-2xl font-bold text-primary mb-6">قضاياي</h2>
    
    @if($cases->count() > 0)
        <div class="overflow-x-auto">
            <table class="table-dashboard">
                <thead>
                    <tr>
                        <th>رقم القضية</th>
                        <th>المحكمة</th>
                        <th>الحالة</th>
                        <th>المحامي</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cases as $case)
                        <tr>
                            <td>{{ $case->case_number }}</td>
                            <td>{{ $case->court_name ?? 'غير محدد' }}</td>
                            <td>
                                <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }}">
                                    {{ $case->status }}
                                </span>
                            </td>
                            <td>{{ $case->lawyer->name ?? 'غير محدد' }}</td>
                            <td>
                                <a href="{{ route('client.cases.show', $case->id) }}" 
                                   class="action-link action-link-view">عرض التفاصيل</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📂</div>
            <p class="text-gray-600 text-lg">لا توجد قضايا مسجلة حالياً</p>
        </div>
    @endif
</div>

<!-- Rating Section -->
<div class="card-attorney p-8">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="text-2xl font-bold text-primary mb-2">شاركنا رأيك</h2>
            <p class="text-gray-600">ساعدنا في تحسين خدماتنا من خلال تقييمك</p>
        </div>
        <a href="{{ route('client.ratings.create') }}" class="btn-attorney-primary">
            إرسال تقييم
        </a>
    </div>
</div>
@endsection

