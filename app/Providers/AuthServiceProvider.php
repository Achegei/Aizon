<?php

namespace App\Providers;
use App\Models\JobApplication;
use App\Policies\JobApplicationPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Import models and policies
use App\Models\Tool;
use App\Policies\ToolPolicy;
use App\Models\Course;
use App\Policies\CoursePolicy;
use App\Models\Job;
use App\Policies\JobPolicy;
use App\Models\Order;
use App\Policies\OrderPolicy;
use App\Models\Payout;
use App\Policies\PayoutPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
           Tool::class            => ToolPolicy::class,
            Course::class          => CoursePolicy::class,
            Job::class             => JobPolicy::class,
            JobApplication::class  => JobApplicationPolicy::class, // <-- ADD THIS
            Order::class           => OrderPolicy::class,
            Payout::class          => PayoutPolicy::class,
            ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Optional: define additional Gates if needed
        Gate::define('access-admin-panel', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('access-creator-tools', function ($user) {
            return $user->isCreator();
        });

        Gate::define('access-employer-jobs', function ($user) {
            return $user->isEmployer();
        });
    }
}
