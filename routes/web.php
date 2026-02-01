<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Creator\DashboardController as CreatorDashboard;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboard;

// --------------------
// Public Pages
// --------------------
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/ai-tools', [PageController::class, 'aiTools'])->name('public.tools.index');
Route::get('/courses', [PageController::class, 'courses'])->name('public.courses.index'); // renamed
Route::get('/jobs', [PageController::class, 'jobs'])->name('public.jobs.index');
Route::get('/hire-talent', [PageController::class, 'hireTalent'])->name('public.hire.index');
Route::get('/sell-on-aizon', [PageController::class, 'sell'])->name('public.sell.index');
Route::get('/pricing', [PageController::class, 'pricing'])->name('public.pricing.index');

Route::get('/dashboard', DashboardController::class)
    ->middleware('auth')
    ->name('dashboard');

// --------------------
// Authentication
// --------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Password reset
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// --------------------
// Admin Routes
// --------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('tools', \App\Http\Controllers\Admin\ToolController::class);
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class)->names([
        'index' => 'courses.index',
        'create' => 'courses.create',
        'store' => 'courses.store',
        'show' => 'courses.show',
        'edit' => 'courses.edit',
        'update' => 'courses.update',
        'destroy' => 'courses.destroy',
    ]);
    Route::resource('jobs', \App\Http\Controllers\Admin\JobController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('payouts', \App\Http\Controllers\Admin\PayoutController::class);
});

// --------------------
// Creator Routes
// --------------------
Route::middleware(['auth', 'creator'])->prefix('creator')->name('creator.')->group(function () {
    Route::get('/dashboard', [CreatorDashboard::class, 'index'])->name('dashboard');

    // Tools CRUD
    Route::prefix('tools')->name('tools.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Creator\ToolController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Creator\ToolController::class, 'create'])->name('create');
        Route::get('/{tool}/edit', [\App\Http\Controllers\Creator\ToolController::class, 'edit'])->name('edit');
    });

    // Courses CRUD
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Creator\CourseController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Creator\CourseController::class, 'create'])->name('create');
        Route::get('/{course}/edit', [\App\Http\Controllers\Creator\CourseController::class, 'edit'])->name('edit');
    });

    // Earnings
    Route::get('/earnings', [\App\Http\Controllers\Creator\EarningsController::class, 'index'])->name('earnings.index');
});

// --------------------
// Employer Routes
// --------------------
Route::middleware(['auth', 'employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerDashboard::class, 'index'])->name('dashboard');

    // Jobs CRUD
    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Employer\JobController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Employer\JobController::class, 'create'])->name('create');
        Route::get('/{job}/edit', [\App\Http\Controllers\Employer\JobController::class, 'edit'])->name('edit');
    });
});

// --------------------
// Quick Test Endpoint
// --------------------
Route::get('/test-dashboard', function () {
    return [
        'user' => auth()->user() ? auth()->user()->only(['id', 'name', 'email', 'role']) : null,
        'routes' => [
            'creator_tools_index' => route('creator.tools.index'),
            'creator_courses_index' => route('creator.courses.index'),
            'employer_jobs_index' => route('employer.jobs.index'),
            'admin_dashboard' => route('admin.dashboard'),
        ]
    ];
})->middleware('auth');
