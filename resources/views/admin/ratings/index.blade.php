@extends('layouts.admin')

@section('title', 'إدارة التقييمات')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-primary mb-2">إدارة التقييمات</h1>
    <p class="text-gray-600 text-lg">مراجعة واعتماد التقييمات من العملاء</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">قيد المراجعة</p>
                <p class="stat-number" style="color: #0066cc;">{{ $pendingCount }}</p>
            </div>
            <div class="text-5xl opacity-20">⏳</div>
        </div>
    </div>
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">معتمدة</p>
                <p class="stat-number text-primary">{{ $approvedCount }}</p>
            </div>
            <div class="text-5xl opacity-20">✅</div>
        </div>
    </div>
    <div class="card-dashboard">
        <div class="flex items-center justify-between">
            <div>
                <p class="stat-label">مرفوضة</p>
                <p class="stat-number" style="color: #dc2626;">{{ $rejectedCount }}</p>
            </div>
            <div class="text-5xl opacity-20">❌</div>
        </div>
    </div>
</div>

<div class="card-attorney p-8">
    @if($ratings->count() > 0)
        <div class="overflow-x-auto">
            <table class="table-dashboard">
                <thead>
                    <tr>
                        <th>العميل</th>
                        <th>التقييم</th>
                        <th>التعليق</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ratings as $rating)
                        <tr>
                            <td class="font-semibold text-primary">{{ $rating->client->name }}</td>
                            <td>
                                <div class="flex gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="text-xl {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                    @endfor
                                    <span class="mr-2 text-gray-600">({{ $rating->rating }}/5)</span>
                                </div>
                            </td>
                            <td>{{ Str::limit($rating->comment ?? 'لا يوجد تعليق', 50) }}</td>
                            <td>
                                @if($rating->status === 'pending')
                                    <span class="badge-dashboard badge-processing">قيد المراجعة</span>
                                @elseif($rating->status === 'approved')
                                    <span class="badge-dashboard badge-completed">معتمد</span>
                                @else
                                    <span class="badge-dashboard badge-cancelled">مرفوض</span>
                                @endif
                            </td>
                            <td>{{ $rating->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="flex gap-2 flex-wrap">
                                    @if($rating->status === 'pending')
                                        <button type="button" 
                                                class="action-link action-link-view"
                                                onclick="showConfirmModal('approve', {{ $rating->id }}, '{{ $rating->client->name }}', '{{ $rating->rating }}')">
                                            موافقة
                                        </button>
                                        <button type="button" 
                                                class="action-link action-link-delete"
                                                onclick="showConfirmModal('reject', {{ $rating->id }}, '{{ $rating->client->name }}', '{{ $rating->rating }}')">
                                            رفض
                                        </button>
                                    @endif
                                    <button type="button" 
                                            class="action-link action-link-delete"
                                            onclick="showConfirmModal('delete', {{ $rating->id }}, '{{ $rating->client->name }}', '{{ $rating->rating }}')">
                                        حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $ratings->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">⭐</div>
            <p class="text-gray-600 text-lg">لا توجد تقييمات</p>
        </div>
    @endif
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="modal-overlay" onclick="closeModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div class="modal-icon" id="modalIcon">
                <!-- Icon will be set by JavaScript -->
            </div>
            <h3 class="modal-title" id="modalTitle">تأكيد العملية</h3>
        </div>
        <div class="modal-body">
            <p class="modal-message" id="modalMessage"></p>
            <div class="modal-rating-info" id="modalRatingInfo" style="display: none;">
                <div class="flex items-center gap-2 mt-4 p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm text-gray-600">التقييم:</span>
                    <div class="flex gap-1" id="modalStars"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <form id="confirmForm" method="POST" class="inline">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <button type="button" onclick="closeModal()" class="btn-modal-cancel">
                    إلغاء
                </button>
                <button type="submit" class="btn-modal-confirm" id="confirmButton">
                    تأكيد
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function showConfirmModal(action, ratingId, clientName, rating) {
        const modal = document.getElementById('confirmModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalIcon = document.getElementById('modalIcon');
        const confirmForm = document.getElementById('confirmForm');
        const confirmButton = document.getElementById('confirmButton');
        const formMethod = document.getElementById('formMethod');
        const modalRatingInfo = document.getElementById('modalRatingInfo');
        const modalStars = document.getElementById('modalStars');

        // Set form action and method
        if (action === 'approve') {
            confirmForm.action = '{{ route("admin.ratings.approve", ":id") }}'.replace(':id', ratingId);
            formMethod.value = 'POST';
            modalTitle.textContent = 'تأكيد الموافقة على التقييم';
            modalMessage.textContent = `هل أنت متأكد من الموافقة على تقييم العميل "${clientName}"؟`;
            confirmButton.textContent = 'موافقة';
            confirmButton.className = 'btn-modal-confirm btn-modal-success';
            modalIcon.innerHTML = '<svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            modalIcon.className = 'modal-icon modal-icon-success';
            modalRatingInfo.style.display = 'block';
            modalStars.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('span');
                star.className = `text-xl ${i <= rating ? 'text-yellow-400' : 'text-gray-300'}`;
                star.textContent = '★';
                modalStars.appendChild(star);
            }
        } else if (action === 'reject') {
            confirmForm.action = '{{ route("admin.ratings.reject", ":id") }}'.replace(':id', ratingId);
            formMethod.value = 'POST';
            modalTitle.textContent = 'تأكيد رفض التقييم';
            modalMessage.textContent = `هل أنت متأكد من رفض تقييم العميل "${clientName}"؟`;
            confirmButton.textContent = 'رفض';
            confirmButton.className = 'btn-modal-confirm btn-modal-warning';
            modalIcon.innerHTML = '<svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            modalIcon.className = 'modal-icon modal-icon-warning';
            modalRatingInfo.style.display = 'block';
            modalStars.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('span');
                star.className = `text-xl ${i <= rating ? 'text-yellow-400' : 'text-gray-300'}`;
                star.textContent = '★';
                modalStars.appendChild(star);
            }
        } else if (action === 'delete') {
            confirmForm.action = '{{ route("admin.ratings.destroy", ":id") }}'.replace(':id', ratingId);
            formMethod.value = 'DELETE';
            modalTitle.textContent = 'تأكيد حذف التقييم';
            modalMessage.textContent = `هل أنت متأكد من حذف تقييم العميل "${clientName}"؟ هذا الإجراء لا يمكن التراجع عنه.`;
            confirmButton.textContent = 'حذف';
            confirmButton.className = 'btn-modal-confirm btn-modal-danger';
            modalIcon.innerHTML = '<svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>';
            modalIcon.className = 'modal-icon modal-icon-danger';
            modalRatingInfo.style.display = 'none';
        }

        modal.style.display = 'flex';
        setTimeout(() => {
            modal.classList.add('modal-show');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('modal-show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>

<style>
    /* Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-overlay.modal-show {
        opacity: 1;
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(0.9) translateY(20px);
        transition: transform 0.3s ease;
    }

    .modal-overlay.modal-show .modal-content {
        transform: scale(1) translateY(0);
    }

    .modal-header {
        padding: 2rem 2rem 1rem;
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
    }

    .modal-icon {
        margin: 0 auto 1rem;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .modal-icon-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .modal-icon-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .modal-icon-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .modal-body {
        padding: 1.5rem 2rem;
    }

    .modal-message {
        font-size: 1.1rem;
        color: #4b5563;
        line-height: 1.6;
        margin: 0;
        text-align: center;
    }

    .modal-rating-info {
        margin-top: 1rem;
    }

    .modal-footer {
        padding: 1rem 2rem 2rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn-modal-cancel {
        background: #f3f4f6;
        color: #374151;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 1rem;
    }

    .btn-modal-cancel:hover {
        background: #e5e7eb;
        transform: translateY(-1px);
    }

    .btn-modal-confirm {
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        color: white;
        font-size: 1rem;
    }

    .btn-modal-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-modal-success:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }

    .btn-modal-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-modal-warning:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
    }

    .btn-modal-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-modal-danger:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
    }

    @media (max-width: 640px) {
        .modal-content {
            width: 95%;
            margin: 1rem;
        }

        .modal-header {
            padding: 1.5rem 1.5rem 1rem;
        }

        .modal-body {
            padding: 1rem 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem 1.5rem;
            flex-direction: column;
        }

        .btn-modal-cancel,
        .btn-modal-confirm {
            width: 100%;
        }

        .modal-title {
            font-size: 1.25rem;
        }

        .modal-message {
            font-size: 1rem;
        }
    }
</style>
@endsection

