@extends('layouts.admin')

@section('title', 'تعديل قضية')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.cases.index') }}" class="text-primary hover:underline font-semibold mb-4 inline-block">
        ← العودة إلى قائمة القضايا
    </a>
</div>

<div class="card-dashboard p-8 max-w-3xl">
    <div class="mb-6 flex items-center gap-3">
        <div class="w-1 h-10 bg-gradient-to-b from-primary to-accent rounded-full"></div>
        <h1 class="text-3xl font-bold text-primary">تعديل قضية</h1>
    </div>
    
    <form method="POST" action="{{ route('admin.cases.update', $case->id) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">رقم القضية <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="text" 
                           name="case_number" 
                           id="case_number" 
                           value="{{ old('case_number', $case->case_number) }}" 
                           class="form-input-attorney pr-10 @error('case_number') border-red-500 @enderror" 
                           required
                           placeholder="CASE-2024-001">
                    <button type="button" 
                            onclick="generateCaseNumber()" 
                            class="btn-generate-case-number"
                            title="توليد رقم تلقائي">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-500 mt-1">يمكنك كتابة رقم مخصص أو استخدام الزر لتوليد رقم تلقائي</p>
                @error('case_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-semibold">العميل <span class="text-red-500">*</span></label>
                <select name="client_id" class="form-input-attorney @error('client_id') border-red-500 @enderror" required>
                    <option value="">اختر العميل</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id', $case->client_id) == $client->id ? 'selected' : '' }}>
                            {{ $client->name }} - {{ $client->national_id }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">المحامي</label>
                <select name="lawyer_id" class="form-input-attorney @error('lawyer_id') border-red-500 @enderror">
                    <option value="">اختر المحامي</option>
                    @foreach($lawyers as $lawyer)
                        <option value="{{ $lawyer->id }}" {{ old('lawyer_id', $case->lawyer_id) == $lawyer->id ? 'selected' : '' }}>
                            {{ $lawyer->name }}
                        </option>
                    @endforeach
                </select>
                @error('lawyer_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-semibold">المحكمة</label>
                <input type="text" name="court_name" value="{{ old('court_name', $case->court_name) }}" 
                       class="form-input-attorney @error('court_name') border-red-500 @enderror">
                @error('court_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-semibold">الحالة <span class="text-red-500">*</span></label>
            <select name="status" class="form-input-attorney @error('status') border-red-500 @enderror" required>
                <option value="قيد المعالجة" {{ old('status', $case->status) == 'قيد المعالجة' ? 'selected' : '' }}>قيد المعالجة</option>
                <option value="قيد المحاكمة" {{ old('status', $case->status) == 'قيد المحاكمة' ? 'selected' : '' }}>قيد المحاكمة</option>
                <option value="منتهية" {{ old('status', $case->status) == 'منتهية' ? 'selected' : '' }}>منتهية</option>
                <option value="ملغاة" {{ old('status', $case->status) == 'ملغاة' ? 'selected' : '' }}>ملغاة</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-semibold">الوصف</label>
            <textarea name="description" rows="5" 
                      class="form-input-attorney @error('description') border-red-500 @enderror">{{ old('description', $case->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="btn-attorney-primary">حفظ التغييرات</button>
            <a href="{{ route('admin.cases.index') }}" class="btn-attorney-secondary">إلغاء</a>
        </div>
    </form>
</div>

<script>
    function generateCaseNumber() {
        const input = document.getElementById('case_number');
        const button = document.querySelector('.btn-generate-case-number');
        
        // Disable button during generation
        if (button) {
            button.disabled = true;
            button.style.opacity = '0.6';
            button.style.cursor = 'not-allowed';
        }
        
        // Get unique case number from backend
        const url = '{{ route("admin.cases.generate-number") }}';
        console.log('Fetching from URL:', url);
        
        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            credentials: 'same-origin'
        })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    // Try to get error message from response
                    return response.text().then(text => {
                        console.error('Error response text:', text);
                        let errorData;
                        try {
                            errorData = JSON.parse(text);
                        } catch (e) {
                            errorData = { error: text || 'Network response was not ok' };
                        }
                        throw new Error(errorData.error || 'Network response was not ok: ' + response.status);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success && data.case_number) {
                    input.value = data.case_number;
                    
                    // Add visual feedback
                    input.classList.add('case-number-generated');
                    setTimeout(() => {
                        input.classList.remove('case-number-generated');
                    }, 1000);
                } else {
                    console.error('Failed to generate case number:', data);
                    alert('حدث خطأ أثناء توليد رقم القضية: ' + (data.error || 'يرجى المحاولة مرة أخرى.'));
                }
            })
            .catch(error => {
                console.error('Error details:', error);
                console.error('Error message:', error.message);
                alert('حدث خطأ أثناء توليد رقم القضية: ' + error.message);
            })
            .finally(() => {
                // Re-enable button
                if (button) {
                    button.disabled = false;
                    button.style.opacity = '1';
                    button.style.cursor = 'pointer';
                }
            });
    }
</script>

<style>
    .btn-generate-case-number {
        position: absolute;
        left: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 0.375rem;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        box-shadow: 0 1px 3px rgba(16, 185, 129, 0.3);
        z-index: 10;
    }

    .btn-generate-case-number:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-50%) scale(1.05);
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.4);
    }

    .btn-generate-case-number:active {
        transform: translateY(-50%) scale(0.95);
    }

    .btn-generate-case-number svg {
        width: 1rem;
        height: 1rem;
    }

    .case-number-generated {
        animation: highlightGenerated 0.5s ease;
    }

    @keyframes highlightGenerated {
        0% {
            background-color: #d1fae5;
            border-color: #10b981;
        }
        100% {
            background-color: white;
        }
    }
</style>
@endsection

