<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobListing;

class JobController extends Controller
{
    /**
     * Display all jobs (for admin).
     * Admin can see both pending and approved jobs.
     */
    public function index()
    {
        $jobs = JobListing::with('employer') // eager load employer
            ->latest()
            ->get();

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Approve an employer job.
     */
    public function approve(JobListing $job)
    {
        $job->update(['is_active' => 1]); // mark as approved

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', "Job '{$job->title}' approved successfully.");
    }

    /**
     * Reject an employer job (optional).
     */
    public function reject(JobListing $job)
    {
        $job->update(['is_active' => 0]); // mark as rejected/inactive

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', "Job '{$job->title}' rejected.");
    }

    /**
     * Show form to edit any job (optional for admin).
     */
    public function edit(JobListing $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update job details (admin).
     */
    public function update(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:255',
            'type'        => 'required|in:full-time,part-time,contract,remote',
            'salary_min'  => 'nullable|numeric|min:0',
            'salary_max'  => 'nullable|numeric|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $job->update($validated);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', "Job '{$job->title}' updated successfully.");
    }

    /**
     * Delete any job (admin).
     */
    public function destroy(JobListing $job)
    {
        $job->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', "Job '{$job->title}' deleted successfully.");
    }
}
