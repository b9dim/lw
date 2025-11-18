@extends('layouts.admin')

@section('title', 'إدارة الاستفسارات')

@section('content')
<h1 class="text-4xl font-bold text-primary mb-8">إدارة الاستفسارات</h1>

<div class="card-attorney p-4 md:p-8">
    @if($inquiries->count() > 0)
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="table-dashboard w-full">
                <thead>
                    <tr>
                        <th>رقم القضية</th>
                        <th>العميل</th>
                        <th>الرسالة</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $inquiry)
                        <tr>
                            <td class="font-mono font-semibold text-primary">{{ $inquiry->case->case_number }}</td>
                            <td class="font-semibold">{{ $inquiry->client->name }}</td>
                            <td>{{ Str::limit($inquiry->message, 50) }}</td>
                            <td>
                                @if($inquiry->reply)
                                    <span class="badge-dashboard badge-completed">تم الرد</span>
                                @else
                                    <span class="badge-dashboard badge-processing">في الانتظار</span>
                                @endif
                            </td>
                            <td>{{ $inquiry->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                                   class="action-link action-link-view">عرض</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($inquiries as $inquiry)
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">رقم القضية</p>
                            <p class="font-mono font-semibold text-primary text-sm break-all">{{ $inquiry->case->case_number }}</p>
                        </div>
                        @if($inquiry->reply)
                            <span class="badge-dashboard badge-completed text-xs ml-2 flex-shrink-0">تم الرد</span>
                        @else
                            <span class="badge-dashboard badge-processing text-xs ml-2 flex-shrink-0">في الانتظار</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">العميل</p>
                        <p class="text-gray-800 font-semibold text-sm">{{ $inquiry->client->name }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">الرسالة</p>
                        <p class="text-gray-800 text-sm">{{ Str::limit($inquiry->message, 100) }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">التاريخ</p>
                        <p class="text-gray-800 text-sm">{{ $inquiry->created_at->format('Y-m-d') }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-100">
                        <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                           class="inline-flex items-center gap-2 text-primary hover:text-accent font-semibold text-sm transition-colors">
                            <span>عرض التفاصيل</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $inquiries->links() }}
        </div>
    @else
        <p class="text-gray-600 text-center py-12">لا توجد استفسارات</p>
    @endif
</div>
@endsection

