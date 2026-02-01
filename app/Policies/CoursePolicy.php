<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Course $course): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isCreator() || $user->isAdmin();
    }

    public function update(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isCreator() && $course->creator_id === $user->id;
    }

    public function delete(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isCreator() && $course->creator_id === $user->id;
    }

    public function restore(User $user, Course $course): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Course $course): bool
    {
        return $user->isAdmin();
    }
}
