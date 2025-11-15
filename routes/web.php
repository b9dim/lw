<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\CasesController;
use App\Http\Controllers\Admin\InquiriesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RatingsController;
use App\Http\Controllers\Client\RatingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');

// Client Auth Routes
Route::get('/client/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientAuthController::class, 'login']);
Route::post('/client/logout', [ClientAuthController::class, 'logout'])->name('client.logout');

// Client Portal Routes
Route::middleware(['auth:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
    Route::get('/cases/{id}', [ClientDashboard::class, 'showCase'])->name('cases.show');
    Route::post('/cases/{caseId}/inquiries', [ClientDashboard::class, 'storeInquiry'])->name('cases.inquiries.store');
    
    // Ratings Routes
    Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

// Admin Auth Routes (using Laravel Breeze default)
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
        'email' => 'بيانات الدخول غير صحيحة.',
    ])->onlyInput('email');
})->middleware('guest');

Route::get('/logout', function () {
    return view('auth.logout');
})->middleware('auth')->name('logout');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout.post');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Clients Management
    Route::resource('clients', ClientsController::class);
    
    // Cases Management
    Route::get('/cases/get-last-number', [CasesController::class, 'getLastCaseNumber'])->name('cases.get-last-number');
    Route::get('/cases/generate-number', [CasesController::class, 'generateCaseNumber'])->name('cases.generate-number');
    Route::post('/cases/{case}/updates', [CasesController::class, 'addUpdate'])->name('cases.updates.store');
    Route::resource('cases', CasesController::class);
    
    // Inquiries Management
    Route::get('/inquiries', [InquiriesController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [InquiriesController::class, 'show'])->name('inquiries.show');
    Route::post('/inquiries/{inquiry}/reply', [InquiriesController::class, 'reply'])->name('inquiries.reply');
    
    // Users Management
    Route::resource('users', UsersController::class);
    
    // Ratings Management
    Route::get('/ratings', [RatingsController::class, 'index'])->name('ratings.index');
    Route::post('/ratings/{rating}/approve', [RatingsController::class, 'approve'])->name('ratings.approve');
    Route::post('/ratings/{rating}/reject', [RatingsController::class, 'reject'])->name('ratings.reject');
    Route::delete('/ratings/{rating}', [RatingsController::class, 'destroy'])->name('ratings.destroy');
});

