@extends('layouts.client')

@section('title', 'إرسال تقييم')

@section('content')
<div class="mb-8">
    <a href="{{ route('client.dashboard') }}" class="text-primary hover:text-accent font-semibold flex items-center gap-2 transition-colors duration-200 hover:underline inline-block mb-4">
        <span class="text-xl">←</span> 
        <span>العودة إلى لوحة التحكم</span>
    </a>
    <h1 class="text-4xl font-bold text-primary mb-2">إرسال تقييم</h1>
    <p class="text-gray-600 text-lg">شاركنا رأيك في خدماتنا</p>
</div>

@if($existingRating)
    <div class="card-attorney p-8 mb-8">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <div class="flex items-start gap-4">
                <div class="text-3xl">⚠️</div>
                <div>
                    <h3 class="text-xl font-bold text-yellow-800 mb-2">لديك تقييم موجود</h3>
                    <p class="text-yellow-700 mb-4">
                        @if($existingRating->status === 'pending')
                            لديك تقييم معلق قيد المراجعة من قبل الإدارة.
                        @elseif($existingRating->status === 'approved')
                            لديك تقييم معتمد مسبقاً.
                        @endif
                    </p>
                    <div class="bg-white rounded-lg p-4 border border-yellow-200">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-lg font-semibold">التقييم:</span>
                            <div class="flex gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-2xl {{ $i <= $existingRating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                @endfor
                            </div>
                        </div>
                        @if($existingRating->comment)
                            <p class="text-gray-700 mt-2"><strong>التعليق:</strong> {{ $existingRating->comment }}</p>
                        @endif
                        <p class="text-sm text-gray-500 mt-2">التاريخ: {{ $existingRating->created_at->format('Y-m-d') }}</p>
                        <p class="text-sm mt-2">
                            <span class="badge-dashboard badge-{{ $existingRating->status === 'approved' ? 'completed' : 'processing' }}">
                                {{ $existingRating->status === 'approved' ? 'معتمد' : 'قيد المراجعة' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card-attorney p-8">
        <form method="POST" action="{{ force_https_route('client.ratings.store') }}">
            @csrf

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <label for="rating" class="block text-lg font-semibold text-gray-700 mb-3">
                    التقييم <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-2 mb-4" id="rating-stars">
                    @for($i = 5; $i >= 1; $i--)
                        <button type="button" 
                                class="star-btn text-5xl transition-all duration-200 hover:scale-110 {{ old('rating', 0) >= $i ? 'text-yellow-400' : 'text-gray-300' }}"
                                data-rating="{{ $i }}">
                            ★
                        </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 0) }}" required>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="comment" class="block text-lg font-semibold text-gray-700 mb-3">
                    التعليق (اختياري)
                </label>
                <textarea name="comment" 
                          id="comment" 
                          rows="6" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                          placeholder="اكتب تعليقك هنا...">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-2">الحد الأقصى 1000 حرف</p>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-attorney-primary">
                    إرسال التقييم
                </button>
                <a href="{{ route('client.dashboard') }}" class="btn-attorney-secondary">
                    إلغاء
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-btn');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    ratingInput.value = rating;
                    
                    stars.forEach((s, index) => {
                        const starRating = parseInt(s.getAttribute('data-rating'));
                        if (starRating <= rating) {
                            s.classList.remove('text-gray-300');
                            s.classList.add('text-yellow-400');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });
                });

                star.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    stars.forEach((s) => {
                        const starRating = parseInt(s.getAttribute('data-rating'));
                        if (starRating <= rating) {
                            s.classList.add('text-yellow-300');
                        }
                    });
                });

                star.addEventListener('mouseleave', function() {
                    const currentRating = parseInt(ratingInput.value);
                    stars.forEach((s) => {
                        const starRating = parseInt(s.getAttribute('data-rating'));
                        if (starRating > currentRating) {
                            s.classList.remove('text-yellow-300');
                        }
                    });
                });
            });
        });
    </script>
@endif
@endsection

