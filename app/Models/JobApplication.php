<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobListing;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_post_id', // matches your table
        'cover_letter',
        'cv_path',
        'status', // optional: pending, accepted, rejected
    ];

    /**
     * Applicant
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Job being applied to
     */
    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_post_id'); // <-- specify custom FK
    }
}
