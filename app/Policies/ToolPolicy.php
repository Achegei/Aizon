<?php

namespace App\Policies;

use App\Models\Tool;
use App\Models\User;

class ToolPolicy
{
    /**
     * Anyone can view published tools
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Anyone can view a single tool
     */
    public function view(?User $user, Tool $tool): bool
    {
        return true;
    }

    /**
     * Only creators and admins can create tools
     */
    public function create(User $user): bool
    {
        return $user->isCreator() || $user->isAdmin();
    }

    /**
     * A creator can update their own tool
     * Admin can update any tool
     */
    public function update(User $user, Tool $tool): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isCreator() && $tool->creator_id === $user->id;
    }

    /**
     * Same rules as update
     */
    public function delete(User $user, Tool $tool): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isCreator() && $tool->creator_id === $user->id;
    }

    /**
     * Optional: restore
     */
    public function restore(User $user, Tool $tool): bool
    {
        return $user->isAdmin();
    }

    /**
     * Optional: force delete
     */
    public function forceDelete(User $user, Tool $tool): bool
    {
        return $user->isAdmin();
    }
}
