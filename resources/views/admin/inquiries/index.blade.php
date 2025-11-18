@extends('layouts.admin')

@section('title', 'إدارة الاستفسارات')

@section('content')
<h1 class="text-4xl font-bold text-primary mb-8">إدارة الاستفسارات</h1>

<div class="card-attorney p-8">
    @if($inquiries->count() > 0)
        <div class="overflow-x-auto">
            <table class="table-dashboard">
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
                            <td>{{ $inquiry->case->case_number }}</td>
                            <td>{{ $inquiry->client->name }}</td>
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
        <div class="mt-6">
            {{ $inquiries->links() }}
        </div>
    @else
        <p class="text-gray-600 text-center py-12">لا توجد استفسارات</p>
    @endif
</div>
@endsection

