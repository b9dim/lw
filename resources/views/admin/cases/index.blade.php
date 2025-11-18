@extends('layouts.admin')

@section('title', 'إدارة القضايا')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold text-primary mb-2">إدارة القضايا</h1>
            <p class="text-gray-600 text-lg">إدارة جميع القضايا والمتابعة</p>
        </div>
        <a href="{{ route('admin.cases.create') }}" class="btn-attorney-primary">
            إضافة قضية جديدة
        </a>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8">
    @if($cases->count() > 0)
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة القضايا</h2>
            </div>
            <span class="badge-dashboard badge-processing">{{ $cases->total() }} قضية</span>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="table-dashboard w-full">
                <thead>
                    <tr>
                        <th>رقم القضية</th>
                        <th>العميل</th>
                        <th>المحكمة</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cases as $case)
                        <tr>
                            <td class="font-mono font-semibold text-primary">{{ $case->case_number }}</td>
                            <td class="font-semibold">{{ $case->client->name }}</td>
                            <td>{{ $case->court_name ?? '-' }}</td>
                            <td>
                                <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }}">
                                    {{ $case->status }}
                                </span>
                            </td>
                            <td>
                                <div class="flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.cases.show', $case->id) }}" 
                                       class="action-link action-link-view">عرض</a>
                                    <a href="{{ route('admin.cases.edit', $case->id) }}" 
                                       class="action-link action-link-edit">تعديل</a>
                                    <form method="POST" action="{{ force_https_route('admin.cases.destroy', $case->id) }}" 
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
            @foreach($cases as $case)
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">رقم القضية</p>
                            <p class="font-mono font-semibold text-primary text-sm break-all">{{ $case->case_number }}</p>
                        </div>
                        <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }} text-xs ml-2 flex-shrink-0">
                            {{ $case->status }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">العميل</p>
                        <p class="text-gray-800 font-semibold text-sm">{{ $case->client->name }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">المحكمة</p>
                        <p class="text-gray-800 text-sm">{{ $case->court_name ?? '-' }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-100 flex gap-2 flex-wrap">
                        <a href="{{ route('admin.cases.show', $case->id) }}" 
                           class="flex-1 text-center px-3 py-2 bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors text-sm font-semibold">
                            عرض
                        </a>
                        <a href="{{ route('admin.cases.edit', $case->id) }}" 
                           class="flex-1 text-center px-3 py-2 bg-accent/10 text-accent rounded-lg hover:bg-accent/20 transition-colors text-sm font-semibold">
                            تعديل
                        </a>
                        <form method="POST" action="{{ force_https_route('admin.cases.destroy', $case->id) }}" 
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
            {{ $cases->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-6 opacity-30">⚖️</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">لا توجد قضايا مسجلة</h3>
            <p class="text-gray-500 mb-6">ابدأ بإضافة قضية جديدة</p>
            <a href="{{ route('admin.cases.create') }}" class="btn-attorney-primary inline-block">
                إضافة قضية جديدة
            </a>
        </div>
    @endif
</div>
@endsection

