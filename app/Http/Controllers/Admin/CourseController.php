<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display all courses (admin list)
     */
    public function index()
    {
        $courses = Course::with('creator')
            ->latest()
            ->get();

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * View a course in full (admin preview)
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Approve a course
     */
    public function approve(Course $course)
    {
        $course->update([
            'is_approved' => true,
            'is_active'   => true,
            'status'      => 'active',
        ]);

        return back()->with('success', 'Course approved successfully.');
    }

    /**
     * Unapprove / Disapprove a course
     */
    public function disapprove(Course $course)
    {
        $course->update([
            'is_approved' => false,
            'is_active'   => false,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Course unapproved successfully.');
    }

    /**
     * Delete a course
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
}
