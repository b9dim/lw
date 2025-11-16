<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>دخول الإدارة - شركة مسفر محمد العرجاني</title>
    @include('components.vite-assets', ['assets' => ['resources/css/app.css', 'resources/js/app.js']])
</head>
<body class="bg-section-light min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card-dashboard p-10">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-primary mb-2">دخول الإدارة</h1>
                    <p class="text-gray-600">شركة مسفر محمد العرجاني</p>
                </div>
                
                <form method="POST" action="{{ force_https_route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">البريد الإلكتروني <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="form-input-attorney @error('email') border-red-500 @enderror" 
                               required autofocus placeholder="example@lawfirm.sa">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">كلمة المرور <span class="text-red-500">*</span></label>
                        <input type="password" name="password" 
                               class="form-input-attorney @error('password') border-red-500 @enderror" 
                               required placeholder="••••••••">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="ml-2 w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                        <label for="remember" class="text-gray-700 cursor-pointer">تذكرني</label>
                    </div>

                    <button type="submit" class="btn-attorney-primary w-full">دخول</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

