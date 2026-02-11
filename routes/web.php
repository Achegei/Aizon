<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\EnrollmentController;

// Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Creator\ToolRequestController;

// Admin
use App\Http\Controllers\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\ToolController as AdminToolController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;

// Creator
use App\Http\Controllers\Creator\DashboardController as CreatorDashboard;
use App\Http\Controllers\Creator\EnrollmentController as CreatorEnrollmentController;


// Employer
use App\Http\Controllers\Employer\DashboardController as EmployerDashboard;
use App\Http\Controllers\Employer\JobController as EmployerJobController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/ai-tools', [PageController::class, 'aiTools'])->name('public.tools.index');
// Tool Request POST route (like enrollment)
Route::post('/ai-tools/{tool:slug}/request', [\App\Http\Controllers\Creator\ToolRequestController::class, 'store'])
    ->name('tools.request')
    ->middleware('auth');
Route::get('/ai-tools/{tool:slug}', [PageController::class, 'showTool'])->name('public.tools.show');
Route::get('/courses', [PageController::class, 'courses'])->name('public.courses.index');
// Enrollment POST route
Route::post('/courses/{course:slug}/enroll', [EnrollmentController::class, 'store'])
    ->name('courses.enroll')
    ->middleware('auth');
Route::get('/courses/{course:slug}', [PageController::class, 'courseShow'])->name('public.courses.show');
Route::get('/jobs', [PageController::class, 'jobs'])->name('public.jobs.index');
Route::get('/jobs/{job}', [PageController::class, 'jobShow'])->name('public.jobs.show');
Route::get('/hire-talent', [PageController::class, 'hireTalent'])->name('public.hire.index');
Route::get('/sell-on-aizon', [PageController::class, 'sell'])->name('public.sell.index');
Route::get('/pricing', [PageController::class, 'pricing'])->name('public.pricing.index');
Route::get('/about', [PageController::class, 'about'])->name('public.about');
Route::get('/faqs', [PageController::class, 'faqs'])->name('public.faqs');
Route::get('/terms', [PageController::class, 'terms'])->name('public.terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('public.privacy');


// Job application route (requires login)
Route::middleware('auth')->group(function () {
    Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED DASHBOARD (GENERIC)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', DashboardController::class)
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION (GENERAL USERS)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PASSWORD RESET
|--------------------------------------------------------------------------
*/
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH & DASHBOARD
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin login (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLogin::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLogin::class, 'login'])->name('login.submit');
    });

    // Admin protected routes
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLogin::class, 'logout'])->name('logout');

        /*
        |--------------------------------------------------------------------------
        | ADMIN CRUD - USERS
        |--------------------------------------------------------------------------
        */
        Route::resource('users', AdminUserController::class);
        Route::patch('users/{user}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
        Route::patch('users/{user}/disapprove', [AdminUserController::class, 'disapprove'])->name('users.disapprove');

        /*
        |--------------------------------------------------------------------------
        | ADMIN CRUD - JOBS
        |--------------------------------------------------------------------------
        */
        Route::resource('jobs', AdminJobController::class);
        Route::patch('jobs/{job}/approve', [AdminJobController::class, 'approve'])->name('jobs.approve');
        Route::patch('jobs/{job}/reject', [AdminJobController::class, 'reject'])->name('jobs.reject');

        /*
        |--------------------------------------------------------------------------
        | ADMIN CRUD - TOOLS
        |--------------------------------------------------------------------------
        */
        Route::get('tools', [AdminToolController::class, 'index'])->name('tools.index');
        Route::get('tools/{tool:id}', [AdminToolController::class, 'show'])->name('tools.show');
        Route::patch('tools/{tool:id}/approve', [AdminToolController::class, 'approve'])->name('tools.approve');
        Route::patch('tools/{tool:id}/disapprove', [AdminToolController::class, 'disapprove'])->name('tools.disapprove');
        Route::delete('tools/{tool:id}', [AdminToolController::class, 'destroy'])->name('tools.destroy');

        /*
        |--------------------------------------------------------------------------
        | ADMIN CRUD - COURSES
        |--------------------------------------------------------------------------
        */
        Route::get('courses', [AdminCourseController::class, 'index'])->name('courses.index');
        Route::get('courses/{course}', [AdminCourseController::class, 'show'])->name('courses.show');
        Route::patch('courses/{course}/approve', [AdminCourseController::class, 'approve'])->name('courses.approve');
        Route::patch('courses/{course}/disapprove', [AdminCourseController::class, 'disapprove'])->name('courses.disapprove');
        Route::delete('courses/{course}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');
        

        /*
        |--------------------------------------------------------------------------
        | ADMIN CRUD - ORDERS & PAYOUTS
        |--------------------------------------------------------------------------
        */
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('payouts', \App\Http\Controllers\Admin\PayoutController::class);
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ROLES (SUPER ADMIN / ADMIN ONLY)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:super_admin|admin'])
    ->group(function () {
        Route::resource('roles', RolesController::class);
    });

/*
|--------------------------------------------------------------------------
| CREATOR ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'creator', 'approved'])
    ->prefix('creator')
    ->name('creator.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [CreatorDashboard::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | CREATOR TOOLS
        |--------------------------------------------------------------------------
        */
        Route::prefix('tools')->name('tools.')->group(function () {
            // List all tools
            Route::get('/', [\App\Http\Controllers\Creator\ToolController::class, 'index'])->name('index');

            // Create new tool
            Route::get('/create', [\App\Http\Controllers\Creator\ToolController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Creator\ToolController::class, 'store'])->name('store');

            // Edit / Update / Delete
            Route::get('/{tool}/edit', [\App\Http\Controllers\Creator\ToolController::class, 'edit'])->name('edit');
            Route::put('/{tool}', [\App\Http\Controllers\Creator\ToolController::class, 'update'])->name('update');
            Route::delete('/{tool}', [\App\Http\Controllers\Creator\ToolController::class, 'destroy'])->name('destroy');

            // List all requests for creator
            Route::get('/requests', [\App\Http\Controllers\Creator\ToolRequestController::class, 'index'])
                ->name('requests.index');
        });

        /*
        |--------------------------------------------------------------------------
        | CREATOR COURSES
        |--------------------------------------------------------------------------
        | Using {id} avoids slug conflicts with public routes
        */
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Creator\CourseController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Creator\CourseController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Creator\CourseController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Creator\CourseController::class, 'edit'])->name('edit');
            Route::put('/{id}', [\App\Http\Controllers\Creator\CourseController::class, 'update'])->name('update');
            Route::delete('/{id}', [\App\Http\Controllers\Creator\CourseController::class, 'destroy'])->name('destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | CREATOR ANALYTICS / SALES VISIBILITY
        |--------------------------------------------------------------------------
        */
        Route::prefix('analytics')->name('analytics.')->group(function () {
            // Who enrolled in my courses
            Route::get('/enrollments', [\App\Http\Controllers\Creator\EnrollmentController::class, 'index'])
                ->name('enrollments.index');

            // Who purchased my tools
            //Route::get('/tool-purchases', [\App\Http\Controllers\Creator\ToolPurchaseController::class, 'index'])
                //->name('tool-purchases.index');
        });

        /*
        |--------------------------------------------------------------------------
        | CREATOR EARNINGS
        |--------------------------------------------------------------------------
        */
        Route::get('/earnings', [\App\Http\Controllers\Creator\EarningsController::class, 'index'])
            ->name('earnings.index');
    });

/*
|--------------------------------------------------------------------------
| EMPLOYER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'employer', 'approved'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [EmployerDashboard::class, 'index'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | JOBS
        |--------------------------------------------------------------------------
        */
        Route::prefix('jobs')->name('jobs.')->group(function () {
            Route::get('/', [EmployerJobController::class, 'index'])->name('index');
            Route::get('/create', [EmployerJobController::class, 'create'])->name('create');
            Route::post('/', [EmployerJobController::class, 'store'])->name('store');
            Route::get('/{job}/edit', [EmployerJobController::class, 'edit'])->name('edit');
            Route::put('/{job}', [EmployerJobController::class, 'update'])->name('update');
            Route::delete('/{job}', [EmployerJobController::class, 'destroy'])->name('destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | APPLICATIONS
        |--------------------------------------------------------------------------
        */
        Route::prefix('applications')->name('applications.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Employer\ApplicationController::class, 'index'])->name('index');
            Route::get('/{application}', [\App\Http\Controllers\Employer\ApplicationController::class, 'show'])->name('show');

             // ✅ Add this PATCH route for updating application status
        Route::patch('/{application}/status', [\App\Http\Controllers\Employer\ApplicationController::class, 'updateStatus'])
        ->name('updateStatus');
        });

        /*
        |--------------------------------------------------------------------------
        | ACCOUNT / PROFILE
        |--------------------------------------------------------------------------
        */
        Route::prefix('account')->name('account.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Employer\AccountController::class, 'edit'])->name('edit');
            Route::post('/', [\App\Http\Controllers\Employer\AccountController::class, 'update'])->name('update');
        });

    });

/*
|--------------------------------------------------------------------------
| QUICK TEST ENDPOINT
|--------------------------------------------------------------------------
*/
Route::get('/test-dashboard', function () {
    return [
        'user' => auth()->user()
            ? auth()->user()->only(['id', 'name', 'email', 'role', 'is_active', 'is_approved'])
            : null,
        'routes' => [
            'creator_tools_index' => route('creator.tools.index'),
            'creator_courses_index' => route('creator.courses.index'),
            'employer_jobs_index' => route('employer.jobs.index'),
            'admin_dashboard' => route('admin.dashboard'),
        ]
    ];
})->middleware('auth');
