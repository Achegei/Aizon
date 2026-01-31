<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Optional: Pass demo data for tools/courses/jobs if backend exists
        return view('pages.home');
    }

    public function aiTools()
    {
        // Fetch real tools once backend exists
        $tools = []; // placeholder
        return view('pages.ai-tools', compact('tools'));
    }

    public function courses()
    {
        $courses = [];
        return view('pages.courses', compact('courses'));
    }

    public function jobs()
    {
        $jobs = [];
        return view('pages.jobs', compact('jobs'));
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
