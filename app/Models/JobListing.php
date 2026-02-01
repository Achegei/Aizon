<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
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

    // Employer relationship
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
