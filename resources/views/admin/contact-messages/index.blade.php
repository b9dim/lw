@extends('layouts.admin')

@section('title', 'رسائل اتصل بنا')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold text-primary mb-2">رسائل اتصل بنا</h1>
            <p class="text-gray-600 text-lg">إدارة رسائل الاتصال الواردة من الموقع</p>
        </div>
    </div>
</div>

<div class="card-dashboard p-4 md:p-8">
    @if($messages->count() > 0)
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-primary">قائمة الرسائل</h2>
            </div>
            <span class="badge-dashboard badge-processing">{{ $messages->total() }} رسالة</span>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="table-dashboard w-full">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الموضوع</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        <tr class="{{ !$message->read ? 'bg-blue-50' : '' }}">
                            <td class="font-semibold {{ !$message->read ? 'text-primary' : 'text-gray-800' }}">{{ $message->name }}</td>
                            <td class="text-gray-700">{{ $message->email }}</td>
                            <td>{{ Str::limit($message->subject, 50) }}</td>
                            <td>
                                @if($message->read)
                                    <span class="badge-dashboard badge-completed">مقروءة</span>
                                @else
                                    <span class="badge-dashboard badge-processing">جديدة</span>
                                @endif
                            </td>
                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                       class="action-link action-link-view">عرض</a>
                                    <form method="POST" action="{{ force_https_route('admin.contact-messages.destroy', $message->id) }}" 
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
            @foreach($messages as $message)
                <div class="bg-white rounded-lg border {{ !$message->read ? 'border-primary/30 bg-blue-50' : 'border-gray-200' }} p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">الاسم</p>
                            <p class="text-gray-800 font-semibold text-sm">{{ $message->name }}</p>
                        </div>
                        @if($message->read)
                            <span class="badge-dashboard badge-completed text-xs ml-2 flex-shrink-0">مقروءة</span>
                        @else
                            <span class="badge-dashboard badge-processing text-xs ml-2 flex-shrink-0">جديدة</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <p class="text-xs text-gray-500 mb-1">البريد الإلكتروني</p>
                        <p class="text-gray-800 text-sm break-all">{{ $message->email }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">الموضوع</p>
                        <p class="text-gray-800 text-sm">{{ Str::limit($message->subject, 60) }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">التاريخ</p>
                        <p class="text-gray-800 text-sm">{{ $message->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-100 flex gap-2 flex-wrap">
                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                           class="flex-1 text-center px-3 py-2 bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors text-sm font-semibold">
                            عرض
                        </a>
                        <form method="POST" action="{{ force_https_route('admin.contact-messages.destroy', $message->id) }}" 
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
            {{ $messages->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-6 opacity-30">📧</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">لا توجد رسائل</h3>
            <p class="text-gray-500">لا توجد رسائل اتصال واردة حالياً</p>
        </div>
    @endif
</div>
@endsection

