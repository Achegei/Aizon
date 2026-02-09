<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Employers can see applications for their jobs.
     * Applicants can see their own applications.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['employer', 'applicant']);
    }

    /**
     * View a specific job application
     * - Applicant can view their own application
     * - Employer can view applications for their own jobs
     */
    public function view(User $user, JobApplication $application): bool
    {
        // Ensure job relationship is loaded
        $application->loadMissing('job');

        if ($user->role === 'applicant' && $user->id === $application->user_id) {
            return true;
        }

        if ($user->role === 'employer' && $application->job && $application->job->employer_id === $user->id) {
            return true;
        }

        if ($user->role === 'admin') {
            return true;
        }

        return false;
    }

    /**
     * Create a job application
     * - Only applicants can apply
     */
    public function create(User $user): bool
    {
        return $user->role === 'applicant';
    }

    /**
     * Update a job application
     * - Only the applicant can update their own application
     */
    public function update(User $user, JobApplication $application): bool
    {
        return $user->role === 'applicant' && $user->id === $application->user_id;
    }

    /**
     * Delete a job application
     * - Only the applicant can delete their own application
     */
    public function delete(User $user, JobApplication $application): bool
    {
        return $user->role === 'applicant' && $user->id === $application->user_id;
    }

    /**
     * Restore a job application
     * - Admin only
     */
    public function restore(User $user, JobApplication $application): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Permanently delete a job application
     * - Admin only
     */
    public function forceDelete(User $user, JobApplication $application): bool
    {
        return $user->role === 'admin';
    }
}
