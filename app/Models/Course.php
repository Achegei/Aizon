<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'title',
        'slug',
        'description',
        'price',
        'category_id',
        'status',     // 'active' or 'inactive'
        'is_active',  // admin approval flag
        'is_approved', // approval by admin
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'creator_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    public function media()
    {
        return $this->hasMany(\App\Models\Media::class);
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'course_tag', 'course_id', 'tag_id')
                    ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->is_active;
    }

    public function formattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | Model Events
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title) . '-' . Str::random(6);
            }
        });

        static::creating(function ($course) {
            if (empty($course->status)) {
                $course->status = 'inactive';
            }
        });

        static::creating(function ($course) {
            if (!isset($course->is_active)) {
                $course->is_active = false;
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Route Binding
    |--------------------------------------------------------------------------
    */

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
