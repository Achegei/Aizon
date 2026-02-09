<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Models\Tool;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function aiTools()
    {
        $tools = Tool::with('creator')
            ->where('is_active', true)      // tool is active
            ->where('is_approved', true)    // admin has approved it
            ->where('status', 'active')     // optional safety check
            ->latest()
            ->get();

        return view('pages.ai-tools', compact('tools'));
    }


    
    public function showTool(Tool $tool)
        {
            // Only show tools that are active AND approved
            if (!$tool->isActive()) {
                abort(404);
            }

            return view('pages.tool-show', compact('tool'));
        }



    /**
     * Public course listing
     * Only approved & active courses
     */
    public function courses()
    {
        $courses = Course::with('creator')
            ->where('is_approved', true)   // admin has approved it
            ->where('is_active', true)     // course is marked active
            ->where('status', 'active')    // status is 'active' (optional safety)
            ->latest()
            ->get();

        return view('pages.courses', compact('courses'));
    }


    /**
     * Public single course page
     */
    public function courseShow(Course $course)
        {
            // Only show active & approved courses
            if (!$course->isActive()) {
                abort(404);
            }

            return view('pages.course-single', compact('course'));
        }


    /**
     * Public jobs listing
     */
    public function jobs()
    {
        $jobs = JobListing::with('employer')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('pages.jobs', compact('jobs'));
    }

    /**
     * Public single job page
     */
    public function jobShow(JobListing $job)
    {
        if (!$job->is_active) {
            abort(404);
        }

        return view('pages.job-show', compact('job'));
    }

    public function hireTalent()
    {
        return view('pages.hire-talent');
    }

    public function sell()
    {
        return view('pages.sell-on-aizon');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }
}
