<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobListing;
use App\Models\User;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',              // ✅ correct FK
        'cv_path',
        'cover_letter_path',
        'cover_letter_text',
        'status',              // pending, accepted, rejected
    ];

    /**
     * Applicant (the user who applied)
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
        return $this->belongsTo(JobListing::class, 'job_id'); // ✅ FIXED
    }
}
