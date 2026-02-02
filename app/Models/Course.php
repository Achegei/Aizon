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
        return $this->belongsToMany(\App\Models\Tag::class, 'course_tag', 'course_id', 'tag_id');
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
            // Automatically generate slug if not set
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title) . '-' . Str::random(6);
            }
        });
    }
}
