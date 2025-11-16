@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-primary mb-2">لوحة التحكم</h1>
    <p class="text-gray-600 text-lg">نظرة عامة على النظام والإحصائيات</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">إجمالي القضايا</p>
                <p class="stat-number text-primary">{{ $stats['total_cases'] }}</p>
            </div>
            <div class="icon-circle icon-circle-lg text-primary">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 4v15" />
                    <path d="M7 19h10" />
                    <path d="m5 10 3 6 3-6" />
                    <path d="m13 10 3 6 3-6" />
                </svg>
            </div>
        </div>
    </div>
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">القضايا النشطة</p>
                <p class="stat-number" style="color: #0066cc;">{{ $stats['active_cases'] }}</p>
            </div>
            <div class="icon-circle icon-circle-lg text-primary">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M9 12h6" />
                    <path d="M9 16h4" />
                    <path d="M12 3H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V9l-6-6z" />
                    <path d="M14 3v5h5" />
                </svg>
            </div>
        </div>
    </div>
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">إجمالي العملاء</p>
                <p class="stat-number" style="color: #7c3aed;">{{ $stats['total_clients'] }}</p>
            </div>
            <div class="icon-circle icon-circle-lg text-primary">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="9" cy="7" r="4" />
                    <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                    <path d="M16 7a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" />
                    <path d="M16 21v-2a4 4 0 0 0-4-4h-2" />
                </svg>
            </div>
        </div>
    </div>
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">استفسارات معلقة</p>
                <p class="stat-number" style="color: #dc2626;">{{ $stats['pending_inquiries'] }}</p>
            </div>
            <div class="icon-circle icon-circle-lg icon-circle-accent">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Cases -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card-dashboard p-6">
        <div class="mb-6 flex items-center gap-3">
            <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
            <h2 class="text-2xl font-bold text-primary">آخر القضايا</h2>
        </div>
        @if($recentCases->count() > 0)
            <div class="space-y-4">
                @foreach($recentCases as $case)
                    <div class="border-b border-gray-200 pb-4 last:border-0 hover:bg-gray-50 p-2 rounded transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-primary">{{ $case->case_number }}</p>
                                <p class="text-sm text-gray-600">{{ $case->client->name }}</p>
                            </div>
                            <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }}">
                                {{ $case->status }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.cases.index') }}" class="btn-attorney-secondary mt-6 inline-block">
                عرض الكل ←
            </a>
        @else
            <div class="text-center py-8">
                <div class="icon-circle icon-circle-lg icon-circle-accent mx-auto mb-4">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 7h16M4 12h16M4 17h10" />
                        <rect x="2" y="3" width="20" height="18" rx="2" />
                    </svg>
                </div>
                <p class="text-gray-600">لا توجد قضايا</p>
            </div>
        @endif
    </div>

    <div class="card-dashboard p-6">
        <div class="mb-6 flex items-center gap-3">
            <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
            <h2 class="text-2xl font-bold text-primary">استفسارات معلقة</h2>
        </div>
        @if($recentInquiries->count() > 0)
            <div class="space-y-4">
                @foreach($recentInquiries as $inquiry)
                    <div class="border-b border-gray-200 pb-4 last:border-0 hover:bg-gray-50 p-2 rounded transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-primary">{{ $inquiry->case->case_number }}</p>
                                <p class="text-sm text-gray-600">{{ $inquiry->client->name }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ Str::limit($inquiry->message, 50) }}</p>
                            </div>
                            <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                               class="action-link action-link-view text-sm">عرض</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="btn-attorney-secondary mt-6 inline-block">
                عرض الكل ←
            </a>
        @else
            <div class="text-center py-8">
                <div class="icon-circle icon-circle-lg icon-circle-accent mx-auto mb-4">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M7 7h10a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2.5L12 17v-2H7a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z" />
                    </svg>
                </div>
                <p class="text-gray-600">لا توجد استفسارات معلقة</p>
            </div>
        @endif
    </div>

    <div class="card-dashboard p-6">
        <div class="mb-6 flex items-center gap-3">
            <div class="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full"></div>
            <h2 class="text-2xl font-bold text-primary">تقييمات قيد المراجعة</h2>
        </div>
        @if($recentRatings->count() > 0)
            <div class="space-y-4">
                @foreach($recentRatings as $rating)
                    <div class="border-b border-gray-200 pb-4 last:border-0 hover:bg-gray-50 p-2 rounded transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-semibold text-primary">{{ $rating->client->name }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="text-sm {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-500">({{ $rating->rating }}/5)</span>
                                </div>
                                @if($rating->comment)
                                    <p class="text-sm text-gray-500 mt-2">{{ Str::limit($rating->comment, 60) }}</p>
                                @endif
                            </div>
                            <a href="{{ route('admin.ratings.index') }}" 
                               class="action-link action-link-view text-sm">عرض</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.ratings.index') }}" class="btn-attorney-secondary mt-6 inline-block">
                عرض الكل ←
            </a>
        @else
            <div class="text-center py-8">
                <div class="icon-circle icon-circle-lg icon-circle-accent mx-auto mb-4">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <p class="text-gray-600">لا توجد تقييمات قيد المراجعة</p>
            </div>
        @endif
    </div>
</div>
@endsection

