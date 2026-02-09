<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobApplication;
use App\Enums\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Employers can see applications for jobs they own
     * Applicants can see their own applications
     */
    public function view(User $user, JobApplication $application): bool
    {
        // Applicants can view their own applications
        if ($user->id === $application->user_id) {
            return true;
        }

        // Employers can view applications for jobs they own
        if (
            $user->role === UserRole::EMPLOYER &&
            optional($application->job)->employer_id === $user->id
        ) {
            return true;
        }

        return false;
    }
}
