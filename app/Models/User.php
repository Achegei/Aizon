<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',        // Enum-backed column
        'settings',    // JSON user preferences
        'is_active',
        'is_approved', // For marketplace approval workflow
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

        // Laravel default hashed password
        'password' => 'hashed',

        // Flags
        'is_active' => 'boolean',
        'is_approved' => 'boolean',

        // JSON
        'settings' => 'array',

        // PHP 8.1 enum cast
        'role' => UserRole::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin(): bool
    {
        return $this->role === UserRole::SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, [
            UserRole::SUPER_ADMIN,
            UserRole::ADMIN,
        ]);
    }

    public function isStaff(): bool
    {
        return $this->role === UserRole::STAFF;
    }

    public function isCreator(): bool
    {
        return $this->role === UserRole::CREATOR;
    }

    public function isEmployer(): bool
    {
        return $this->role === UserRole::EMPLOYER;
    }

    public function isMember(): bool
    {
        return $this->role === UserRole::MEMBER;
    }


    /*
    |--------------------------------------------------------------------------
    | Approval Workflow
    |--------------------------------------------------------------------------
    */

    public function needsApproval(): bool
    {
        return in_array($this->role, [UserRole::CREATOR, UserRole::EMPLOYER]) && !$this->is_approved;
    }

    public function canPerform(string $action): bool
    {
        // Example dynamic permissions logic
        // You could replace this with a permissions table later
        $permissions = [
            UserRole::SUPER_ADMIN->value => ['manage_admins','manage_staff','approve_users','delete_users','post_jobs','access_marketplace'],
            UserRole::ADMIN->value       => ['manage_staff','approve_users','delete_users','post_jobs','access_marketplace'],
            UserRole::STAFF->value       => ['post_jobs','access_marketplace'],
        ];

        return in_array($action, $permissions[$this->role->value] ?? []);
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function jobApplications()
    {
        return $this->hasMany(\App\Models\JobApplication::class);
    }

    public function tools()
    {
        return $this->hasMany(\App\Models\Tool::class, 'creator_id');
    }

    public function courses()
    {
        return $this->hasMany(\App\Models\Course::class, 'creator_id');
    }

    public function payouts()
    {
        return $this->hasMany(\App\Models\Payout::class, 'user_id');
    }
}
