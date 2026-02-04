<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Get all approved courses (optional)
        $courses = Course::with('creator')
            ->where('is_approved', true) // if you have approval workflow
            ->latest()
            ->get();

        return view('courses.index', compact('courses'));
    }
}
