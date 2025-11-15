@extends('layouts.admin')

@section('title', 'تعديل مستخدم')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.users.index') }}" class="text-primary hover:underline font-semibold mb-4 inline-block">
        ← العودة إلى قائمة المستخدمين
    </a>
</div>

<div class="card-dashboard p-8 max-w-3xl">
    <div class="mb-6 flex items-center gap-3">
        <div class="w-1 h-10 bg-gradient-to-b from-primary to-accent rounded-full"></div>
        <h1 class="text-3xl font-bold text-primary">تعديل مستخدم</h1>
    </div>
    
    <form method="POST" action="{{ secure_url(route('admin.users.update', $user->id)) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">الاسم <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="form-input-attorney @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-semibold">البريد الإلكتروني <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="form-input-attorney @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">كلمة المرور (اتركه فارغاً إذا لم ترد التغيير)</label>
                <input type="password" name="password" 
                       class="form-input-attorney @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-semibold">الدور <span class="text-red-500">*</span></label>
                <select name="role" class="form-input-attorney @error('role') border-red-500 @enderror" required>
                    <option value="مدير" {{ old('role', $user->role) == 'مدير' ? 'selected' : '' }}>مدير</option>
                    <option value="محامي" {{ old('role', $user->role) == 'محامي' ? 'selected' : '' }}>محامي</option>
                    <option value="موظف استقبال" {{ old('role', $user->role) == 'موظف استقبال' ? 'selected' : '' }}>موظف استقبال</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="btn-attorney-primary">حفظ التغييرات</button>
            <a href="{{ route('admin.users.index') }}" class="btn-attorney-secondary">إلغاء</a>
        </div>
    </form>
</div>
@endsection

