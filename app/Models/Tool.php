<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Tool extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'creator_id',
        'title',
        'slug',
        'description',
        'price',
        'category_id',
        'status',      // 'active' or 'inactive'
        'is_active',   // boolean for admin approval
    ];

    /**
     * Attribute casts.
     */
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
        return $this->belongsToMany(\App\Models\Tag::class, 'tool_tag', 'tool_id', 'tag_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Check if tool is active (creator + admin approved).
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->is_active;
    }

    /**
     * Formatted price string.
     */
    public function formattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Boot method to auto-generate slug from title.
     */
    protected static function booted()
    {
        static::creating(function ($tool) {
            if (empty($tool->slug)) {
                $tool->slug = Str::slug($tool->title);
            }
        });

        static::updating(function ($tool) {
            if (empty($tool->slug)) {
                $tool->slug = Str::slug($tool->title);
            }
        });
    }
}
