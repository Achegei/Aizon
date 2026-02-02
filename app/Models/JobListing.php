<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobListing extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = [
        'employer_id',
        'title',
        'slug',
        'description',
        'location',
        'type',
        'salary_min',
        'salary_max',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
