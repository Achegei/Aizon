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

        // Laravel 12 default
        'password' => 'hashed',

        // Flags
        'is_active' => 'boolean',

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

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isCreator(): bool
    {
        return $this->role === UserRole::CREATOR;
    }

    public function isEmployer(): bool
    {
        return $this->role === UserRole::EMPLOYER;
    }

    public function isBuyer(): bool
    {
        return $this->role === UserRole::BUYER;
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
