@extends('layouts.admin')

@section('title', 'إضافة عميل جديد')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.clients.index') }}" class="text-primary hover:underline font-semibold mb-4 inline-block">
        ← العودة إلى قائمة العملاء
    </a>
</div>

<div class="card-dashboard p-8 max-w-3xl">
    <div class="mb-6 flex items-center gap-3">
        <div class="w-1 h-10 bg-gradient-to-b from-primary to-accent rounded-full"></div>
        <h1 class="text-3xl font-bold text-primary">إضافة عميل جديد</h1>
    </div>
    
    <form method="POST" action="{{ force_https_route('admin.clients.store') }}" class="space-y-6">
        @csrf
        
        @if($errors->any())
            <div class="bg-red-50 border-r-4 border-red-500 text-red-700 px-4 py-3 rounded mb-4">
                <p class="font-semibold mb-2">يرجى تصحيح الأخطاء التالية:</p>
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">الاسم <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="form-input-attorney @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-semibold">رقم الهوية <span class="text-red-500">*</span></label>
                <input type="text" name="national_id" value="{{ old('national_id') }}" 
                       class="form-input-attorney @error('national_id') border-red-500 @enderror" 
                       required maxlength="10" pattern="[0-9]{10}" inputmode="numeric"
                       placeholder="10 أرقام">
                @if($errors->has('national_id'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('national_id') }}</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">الهاتف</label>
                <input type="text" name="phone" value="{{ old('phone') }}" 
                       class="form-input-attorney @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-semibold">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="form-input-attorney @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-semibold">كلمة المرور <span class="text-red-500">*</span></label>
            <input type="password" name="password" 
                   class="form-input-attorney @error('password') border-red-500 @enderror" required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="btn-attorney-primary">إضافة العميل</button>
            <a href="{{ route('admin.clients.index') }}" class="btn-attorney-secondary">إلغاء</a>
        </div>
    </form>
</div>
@endsection

