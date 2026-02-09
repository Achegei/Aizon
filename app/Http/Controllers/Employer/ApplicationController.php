<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a list of job applications for the authenticated employer.
     */
    public function index()
    {
        $applications = JobApplication::with(['job', 'user'])
            ->whereHas('job', function ($query) {
                $query->where('employer_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('employer.applications.index', compact('applications'));
    }

    /**
     * Show details of a specific application.
     */
    public function show(JobApplication $application)
    {
        // Eager load relationships so policy checks work
        $application->load('job', 'user');

        // Authorization: employer can view only their own job applications
        $this->authorize('view', $application);

        return view('employer.applications.show', compact('application'));
    }
}
