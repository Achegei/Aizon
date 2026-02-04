<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Show enrollments for the creator's courses
     */
    public function index()
    {
        $creatorId = Auth::id();

        $enrollments = Enrollment::with(['user', 'course'])
            ->whereHas('course', function ($query) use ($creatorId) {
                $query->where('creator_id', $creatorId);
            })
            ->latest()
            ->get();

        return view('creator.analytics.enrollments.index', compact('enrollments'));
    }
}
