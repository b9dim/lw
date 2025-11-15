@extends('layouts.admin')

@section('title', 'تسجيل الخروج')

@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="card-dashboard p-8 max-w-md w-full text-center">
        <div class="mb-6">
            <div class="text-6xl mb-4">👋</div>
            <h1 class="text-3xl font-bold text-primary mb-2">تسجيل الخروج</h1>
            <p class="text-gray-600">هل أنت متأكد من رغبتك في تسجيل الخروج؟</p>
        </div>
        
        <form method="POST" action="{{ secure_url(route('logout.post')) }}" class="space-y-4">
            @csrf
            <div class="flex gap-4 justify-center">
                <button type="submit" class="btn-attorney-primary">
                    نعم، تسجيل الخروج
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn-attorney-secondary">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

