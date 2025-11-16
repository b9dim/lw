@extends('layouts.public')

@section('title', 'دخول العملاء')

@section('content')
<section class="py-20 bg-section-light min-h-screen flex items-center">
    <div class="container mx-auto px-6 md:px-8 lg:px-12">
        <div class="max-w-md mx-auto">
            <div class="card-dashboard p-10">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-primary mb-2">دخول العملاء</h1>
                    <p class="text-gray-600">تابع قضاياك واستفساراتك</p>
                </div>
                
                <form method="POST" action="{{ route('client.login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">رقم الهوية <span class="text-red-500">*</span></label>
                        <input type="text" name="national_id" value="{{ old('national_id') }}" 
                               class="form-input-attorney @error('national_id') border-red-500 @enderror" 
                               required autofocus maxlength="10" pattern="[0-9]{10}" inputmode="numeric"
                               placeholder="10 أرقام">
                        @error('national_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">الرقم السري <span class="text-red-500">*</span></label>
                        <input type="password" name="password" 
                               class="form-input-attorney @error('password') border-red-500 @enderror" 
                               required placeholder="أدخل الرقم السري">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <label for="remember" class="mr-2 text-gray-700">تذكرني</label>
                    </div>

                    @if($errors->any() && !$errors->has('national_id') && !$errors->has('password'))
                        <div class="bg-red-50 border-r-4 border-red-500 text-red-700 px-4 py-3 rounded">
                            <p class="font-semibold">بيانات الدخول غير صحيحة</p>
                            <p class="text-sm mt-1">يرجى التحقق من رقم الهوية والرقم السري</p>
                        </div>
                    @endif

                    <button type="submit" class="btn-attorney-primary w-full">دخول</button>
                </form>

                <div class="mt-8 text-center pt-6 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="text-primary hover:underline font-semibold">← العودة إلى الصفحة الرئيسية</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

