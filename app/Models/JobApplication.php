<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_post_id',
        'cover_letter',
        'cv_path',
        'status',
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
        return $this->belongsTo(JobPost::class, 'job_post_id');
    }
}
