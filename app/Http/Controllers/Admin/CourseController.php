<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Approve a course (admin action).
     */
    public function approve(Course $course)
    {
        $course->update([
            'is_active' => true,
            'status' => 'active', // optional: ensure status aligns
        ]);

        return back()->with('success', 'Course approved successfully.');
    }

    /**
     * Disapprove a course (admin action).
     */
    public function disapprove(Course $course)
    {
        $course->update([
            'is_active' => false,
            'status' => 'inactive', // optional: keep status in sync
        ]);

        return back()->with('success', 'Course disapproved successfully.');
    }

    /**
     * Delete a course.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
}
