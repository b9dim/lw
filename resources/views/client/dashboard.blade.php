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
<div class="card-attorney p-4 md:p-8 mb-8">
    <h2 class="text-2xl font-bold text-primary mb-6">قضاياي</h2>
    
    @if($cases->count() > 0)
        <!-- Desktop Table View (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="table-dashboard w-full">
                <thead>
                    <tr>
                        <th>رقم القضية</th>
                        <th>المحكمة</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($cases as $case)
                            <tr class="js-clickable-row" data-row-href="{{ route('client.cases.show', $case->id) }}" tabindex="0" role="link" aria-label="عرض تفاصيل القضية رقم {{ $case->case_number }}">
                                <td>
                                    <span class="case-number-pill" title="رقم القضية">
                                        <span class="case-number-pill-icon" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M5 12h14" stroke-linecap="round" stroke-width="1.6" />
                                                <path d="M9 6l-2 12M17 6l-2 12" stroke-linecap="round" stroke-width="1.6" />
                                            </svg>
                                        </span>
                                        <span class="case-number-pill-text">{{ $case->case_number }}</span>
                                    </span>
                                </td>
                            <td>{{ $case->court_name ?? 'غير محدد' }}</td>
                            <td>
                                <div class="flex flex-col gap-2">
                                    <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }}">
                                        {{ $case->status }}
                                    </span>
                                    <div class="case-last-update">
                                        <div class="case-last-update-icon">
                                            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                                <circle cx="12" cy="12" r="8.5" fill="none"></circle>
                                                <path d="M12 7.5v4.5l3 1.75" fill="none"></path>
                                            </svg>
                                        </div>
                                        <div class="case-last-update-content">
                                            <span class="case-last-update-label">آخر تحديث</span>
                                            <span class="case-last-update-text">
                                                {{ $case->last_update_text ?? 'لا يوجد تحديث مضاف بعد' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                                <td>
                                    <a href="{{ route('client.cases.show', $case->id) }}" 
                                       class="action-link action-link-view"
                                       data-row-link-ignore>عرض التفاصيل</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (visible only on mobile) -->
        <div class="md:hidden space-y-4">
            @foreach($cases as $case)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow js-clickable-row"
                         data-row-href="{{ route('client.cases.show', $case->id) }}"
                         tabindex="0"
                         role="link"
                         aria-label="عرض تفاصيل القضية رقم {{ $case->case_number }}">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">رقم القضية</p>
                                <span class="case-number-pill w-full justify-between">
                                    <span class="case-number-pill-text break-all">{{ $case->case_number }}</span>
                                </span>
                        </div>
                          <div class="flex flex-col items-end gap-2 text-right">
                              <span class="badge-dashboard badge-{{ str_replace(' ', '-', strtolower($case->status)) }} text-xs ml-2 flex-shrink-0">
                                  {{ $case->status }}
                              </span>
                              <div class="case-last-update">
                                  <div class="case-last-update-icon">
                                      <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                          <circle cx="12" cy="12" r="8.5" fill="none"></circle>
                                          <path d="M12 7.5v4.5l3 1.75" fill="none"></path>
                                      </svg>
                                  </div>
                                  <div class="case-last-update-content text-right">
                                      <span class="case-last-update-label">آخر تحديث</span>
                                      <span class="case-last-update-text leading-snug">
                                          {{ $case->last_update_text ?? 'لا يوجد تحديث مضاف بعد' }}
                                      </span>
                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">المحكمة</p>
                        <p class="text-gray-800 text-sm">{{ $case->court_name ?? 'غير محدد' }}</p>
                    </div>
                        <div class="pt-3 border-t border-gray-100" data-row-link-ignore>
                        <a href="{{ route('client.cases.show', $case->id) }}" 
                               class="inline-flex items-center gap-2 text-primary hover:text-accent font-semibold text-sm transition-colors"
                               data-row-link-ignore>
                            <span>عرض التفاصيل</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
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

