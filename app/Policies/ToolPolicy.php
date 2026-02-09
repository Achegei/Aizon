<?php

namespace App\Policies;

use App\Models\Tool;
use App\Models\User;

class ToolPolicy
{
    /**
     * Anyone can view the list of tools
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
     * Only approved creators and admins can create tools
     */
    public function create(User $user): bool
    {
        return ($user->isCreator() && $user->is_approved) || $user->isAdmin();
    }

    /**
     * Update a tool
     * - Admin can update any tool
     * - Approved creators can update their own tool
     */
    public function update(User $user, Tool $tool): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isCreator() && $user->is_approved && $tool->creator_id === $user->id;
    }

    /**
     * Delete a tool
     * - Admin can delete any tool
     * - Approved creators can delete their own tool
     */
    public function delete(User $user, Tool $tool): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isCreator() && $user->is_approved && $tool->creator_id === $user->id;
    }

    /**
     * Restore a tool (admin only)
     */
    public function restore(User $user, Tool $tool): bool
    {
        return $user->isAdmin();
    }

    /**
     * Force delete a tool (admin only)
     */
    public function forceDelete(User $user, Tool $tool): bool
    {
        return $user->isAdmin();
    }

    /**
 * Any logged-in user can request a tool
 */
    // ToolPolicy.php
    public function request(User $user, Tool $tool): bool
    {
        return $user->id !== $tool->creator_id;
    }


}
