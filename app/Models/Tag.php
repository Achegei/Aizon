<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function courses()
    {
        return $this->belongsToMany(\App\Models\Course::class, 'course_tag', 'tag_id', 'course_id')
                    ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Model Events
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::creating(function ($tag) {
            // Automatically generate slug if not set
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }
}
