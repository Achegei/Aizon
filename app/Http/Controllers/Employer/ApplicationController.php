<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobListing; // Make sure this is imported
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a list of job applications for the authenticated employer.
     */
    public function index()
    {
        $applications = JobApplication::with('job') // make sure relationship exists
            ->whereHas('job', function ($q) {
                $q->where('employer_id', auth()->id());
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
        // Ensure the employer owns the job related to this application
        $this->authorize('view', $application);

        return view('employer.applications.show', compact('application'));
    }
}
