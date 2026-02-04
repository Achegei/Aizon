<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Handle course enrollment form submission
     */
    public function store(Request $request, Course $course)
    {
        $user = Auth::user();

        // Prevent duplicate enrollments
        Enrollment::firstOrCreate([
            'user_id'   => $user->id,
            'course_id' => $course->id,
        ]);

        return back()->with('success', "You have successfully enrolled in {$course->title}!");
    }
}
